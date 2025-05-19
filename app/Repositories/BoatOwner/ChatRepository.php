<?php 
namespace App\Repositories\BoatOwner;

use App\Events\Auth\ChatMessageSent;
use App\Mail\Chat\ChatMessageMailCustomer;
use App\Models\Admin\Listing;
use App\Models\Admin\Quotation;
use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class ChatRepository 
{

    public function sendMessage($request)
    {
        $imagePath = null;
        if ($request->hasFile('image')) 
        {
            $imagePath = $request->file('image')->store('chat_images', 'public');
        }
        $userData = auth()->user();
        $listingId = Listing::where('slug', $request['slug'])->pluck('id')->first();

        $message = $request->message;
        $emailRegex = '/[\w\.-]+@[\w\.-]+\.\w+/i';
        $phoneRegex = '/\d{6,}/';
        if (preg_match($emailRegex, $message) || preg_match($phoneRegex, $message)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Emails and phone number are not allowed in the message.'
            ]);
        }
        $message = Message::create([
            'sender_id' => auth()->id(),
            'receiver_id' => $request->receiver_id,
            'listing_id' => $listingId,
            'message' => $request->message,
            'image' => $imagePath,
        ]);

        $receiverEmail = User::where('id',$request->receiver_id)->value('email');
        $receiverName = User::where('id',$request->receiver_id)->value('name');
        
        Mail::to($receiverEmail)->queue(new ChatMessageMailCustomer([
            'sender_name' => $userData->name,
            'receiver_name' => $receiverName,
            'message' => $request->message,
            'listing_id' => $listingId,
        ]));

        if(empty($userData->getFirstMediaUrl('profile_image'))):
            $userImage =  'https://static1.clickandboat.com/v1/o/img/mask~dddc60cc1d.png';
        else:
            $userImage = $userData->getFirstMediaUrl('profile_image');
        endif;
        $html = '<div class="msg-right">
                    <div class="msg-right-sub">
                        <div class="msg-avatar"><img src="'.$userImage.'"></div>
                        <div class="msg-content">
                            <div class="msg-desc">
                                '.$message->message.'
                            </div>
                            <small class="msg-time">'.Timeago($message['created_at']).'</small>
                        </div>
                    </div>
                </div>';
        return response()->json([
            'html' => $html,
            'status' => 'success',
        ]);
    }
    public function fetchMessages($receiver_id,$listingId)
    {
        $messages = Message::where(function ($query) use ($receiver_id, $listingId) {
            $query->where('sender_id', auth()->id())
                  ->where('receiver_id', $receiver_id)
                  ->where('listing_id', $listingId);
        })->orWhere(function ($query) use ($receiver_id, $listingId) {
            $query->where('sender_id', $receiver_id)
                  ->where('receiver_id', auth()->id())
                  ->where('listing_id', $listingId);
        })->orderBy('created_at', 'asc')->get();
        return $messages;
    }
    public function seeAllMessage($request)
    {
        $receiver_id = $request['receiver_id'];
        $listingId = Listing::where('slug', $request['slug'])->pluck('id')->first();
        $messages = Message::where(function ($query) use ($receiver_id, $listingId) {
            $query->where('sender_id', auth()->id())
                  ->where('receiver_id', $receiver_id)
                  ->where('listing_id', $listingId);
        })->orWhere(function ($query) use ($receiver_id, $listingId) {
            $query->where('sender_id', $receiver_id)
                  ->where('receiver_id', auth()->id())
                  ->where('listing_id', $listingId);
        })->orderBy('created_at', 'asc')->get();
        $html = '';
        $sender = auth()->user();
        $receiver = User::find($receiver_id);
        if($messages):
            foreach($messages as $reply):
                if($reply['sender_id'] == auth()->id()):
                    $class = 'msg-right';
                    $sub_class = 'msg-right-sub';
                    $user_data = $sender;
                else:
                    $class = 'msg-left';
                    $sub_class = 'msg-left-sub';
                    $user_data = $receiver;
                endif;
                
                if(empty($user_data->getFirstMediaUrl('profile_image'))):
                    $user_image =  'https://static1.clickandboat.com/v1/o/img/mask~dddc60cc1d.png';
                else:
                    $user_image = $user_data->getFirstMediaUrl('profile_image');
                endif;
                if($reply['message'])
                {
                    $message = $reply['message'];
                }
                else
                {
                    //$attachment_id = $reply['image'];
                    //$name = $this->common_model->GetSingleValue(MEDIA_TABLE,'name', array('id' => $attachment_id));
                    // $allowed = array('.jpg','.jpeg','.gif','.png');
                    // if (in_array(strtolower(strrchr($name, '.')), $allowed)) {
                    //     $message = '<a href="'.base_url('/uploads/'.$name).'"  target="_blank"><img class="msg_desc_img" style="width: 100px; height: 100px; object-fit:cover;" src="'.base_url('/uploads/'.$name).'"></a>';
                    // }
                    // else
                    // {
                    //     $message = '<a href="'.base_url('/uploads/'.$name).'" target="_blank"><img  class="msg_desc_img" src="'.base_url('assets/front/images/pdf-icon.png').'" style="width: 100px; height: 100px; object-fit:cover;"></a>';
                    // }
                }
            
                $html .= '<div class="'.$class.'">
                    <div class="'.$sub_class.'">
                        <div class="msg-avatar"><img src="'.$user_image.'"></div>
                        <div class="msg-content">
                            <div class="msg-desc">
                                '.$message.'
                            </div>
                             <small>'.Timeago($reply['created_at']).'</small>
                        </div>
                    </div>
                </div>';
            endforeach;
            return response()->json([
                'html' => $html,
                'status' => 'success',
            ]);
        endif;
    }
    // public function usersWithLastMessage()
    // {
    //     $user = auth()->user();
    //     $users = User::whereHas('sentMessages', function ($query) use ($user) {
    //         $query->where('receiver_id', $user->id);
    //     })
    //     ->orWhereHas('receivedMessages', function ($query) use ($user) {
    //         $query->where('sender_id', $user->id);
    //     })
    //     ->with(['sentMessages' => function ($query) use ($user) {
    //         $query->where('receiver_id', $user->id)
    //             ->orderBy('created_at', 'desc')
    //             ->limit(1);
    //     }, 'receivedMessages' => function ($query) use ($user) {
    //         $query->where('sender_id', $user->id)
    //             ->orderBy('created_at', 'desc')
    //             ->limit(1);
    //     }])
    //     ->get();
    //     $usersWithLastMessage = $users->map(function ($user) {
    //         $lastSentMessage = $user->sentMessages->first();
    //         $lastReceivedMessage = $user->receivedMessages->first();
    //         $lastMessage = null;
    //         if ($lastSentMessage && $lastReceivedMessage) {
    //             $lastMessage = $lastSentMessage->created_at > $lastReceivedMessage->created_at ? $lastSentMessage : $lastReceivedMessage;
    //         } elseif ($lastSentMessage) {
    //             $lastMessage = $lastSentMessage;
    //         } elseif ($lastReceivedMessage) {
    //             $lastMessage = $lastReceivedMessage;
    //         }
    //         return [
    //             'user' => $user,
    //             'message' => $lastMessage
    //         ];
    //     });
    //     return $usersWithLastMessage;
    // }
    public function usersWithLastMessage()
    {
        $user = auth()->user();
        $listings = $user->listing()->with(['message' => function ($query) use ($user) {
            $query->where(function ($q) use ($user) {
                $q->where('sender_id', $user->id)
                  ->orWhere('receiver_id', $user->id);
            })->orderBy('created_at', 'desc');
        }])->get();
        $result = [];
        foreach ($listings as $listing) 
        {
            $messages = $listing->message ?? collect();
            $groupedMessages = $messages->groupBy(function ($msg) use ($user) {
                return $msg->sender_id === $user->id ? $msg->receiver_id : $msg->sender_id;
            });
            foreach ($groupedMessages as $otherUserId => $messagesGroup) {
                $lastMessage = $messagesGroup->first();
                $result[] = [
                    'listing' => $listing,
                    'user' => User::find($otherUserId),
                    'message' => $lastMessage,
                ];
            }
        }
        $sortedResult = collect($result)->sortByDesc(function ($item) {
            return $item['message']->created_at;
        })->values(); 
        return $sortedResult;
    }
    public function spcialOfferSend($request)
    {
        $userData = auth()->user();
        $request['checkindate'] = $request['check-in'];
        $request['checkoutdate'] = $request['check-out'];
        $listingId = Listing::where('slug', $request['locationslug'])->pluck('id')->first();
        $request['id'] = $listingId;
        //$price = bookingPrice($request);
        $quotation = Quotation::where('id', $request['quotation'])->first();
        $quotationNetAmount = $quotation['net_amount'];
        $discountPrice = $quotationNetAmount * $request['discount'] / 100;
        $PriceAfterDiscount = $quotationNetAmount - $discountPrice;
        $quotationServiceFee = $quotation['service_fee'];
        $quotation->net_amount = $PriceAfterDiscount;
        $quotation->sub_total = $PriceAfterDiscount + $quotationServiceFee;
        $quotation->total = $PriceAfterDiscount + $quotationServiceFee;
        $quotation->discount = $request['discount'];
        $quotation->status = 'Accept';
        if($quotation->update()):
            $message = Message::create([
                'sender_id' => $userData->id,
                'receiver_id' => $quotation->user_id,
                'listing_id' => $listingId,
                'message' => 'Please check your offer and click on confirm button.',
            ]);
            if(empty($userData->getFirstMediaUrl('profile_image'))):
                $userImage =  'https://static1.clickandboat.com/v1/o/img/mask~dddc60cc1d.png';
            else:
                $userImage = $userData->getFirstMediaUrl('profile_image');
            endif;
            $html = '<div class="msg-right">
                <div class="msg-right-sub">
                    <div class="msg-avatar"><img src="'.$userImage.'"></div>
                    <div class="msg-content">
                        <div class="msg-desc">
                            Please check your offer and click on confirm button.
                        </div>
                        <small class="msg-time">10 Second Ago</small>
                    </div>
                </div>
            </div>';
            return response()->json([
                'html' => $html,
                'status' => 'success',
            ]);
        else:
            return response()->json([
                'status' => 'error',
            ]);
        endif;
    }
    public function updateQuotation($id)
    {
        $userData = auth()->user();
        $quote = Quotation::find($id);
        $quote->status = 'Accept';
        if($quote->update())
        {
            $message = Message::create([
                'sender_id' => $userData->id,
                'receiver_id' => $quote->user_id,
                'listing_id' => $quote->listing_id,
                'message' => 'Please check your offer and click on confirm button.',
            ]);
            $listingSlug = Listing::where('id', $quote->listing_id)->pluck('slug')->first();
            return redirect()->route('boatowner.message',['receiver_id' => $quote->user_id, 'slug' => $listingSlug])->with('success', 'Quotation updated successfully!'); 
        }
        return false;
    }
    public function cancelQuotation($id)
    {
        $userData = auth()->user();
        $quote = Quotation::find($id);
        $quote->status = 'Cancel';
        if($quote->update())
        {
            $message = Message::create([
                'sender_id' => $userData->id,
                'receiver_id' => $quote->user_id,
                'listing_id' => $quote->listing_id,
                'message' => 'Your quotation has been cancelled, please try again later.',
            ]);
            $listingSlug = Listing::where('id', $quote->listing_id)->pluck('slug')->first();
            return redirect()->route('boatowner.message',['receiver_id' => $quote->user_id, 'slug' => $listingSlug])->with('success', 'Quotation updated successfully!'); 
        }
        return false;
    }
    public function seeCountMessage($request)
    {
        $listingId = Listing::where('slug', $request['slug'])->pluck('id')->first();
        $receiver_id = $request['receiver_id'];
        $message = Message::where('sender_id', $receiver_id)
       ->where('listing_id', $listingId)
       ->update(['seen' => 1]);

    }
}