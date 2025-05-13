<?php 
namespace App\Repositories\Customer;

use App\Events\Auth\ChatMessageSent;
use App\Models\Admin\Listing;
use App\Models\Admin\Quotation;
use App\Models\Message;
use App\Models\User;

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
        $listingId = Listing::where('slug', $request['slug'])->pluck('id')->first();
        $receiver_id = $request['receiver_id'];
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
    public function usersWithLastMessage()
    {
        $user = auth()->user();
        $messages = \App\Models\Message::with(['sender', 'receiver'])
            ->where(function ($query) use ($user) {
                $query->where('sender_id', $user->id)
                      ->orWhere('receiver_id', $user->id);
            })
            ->orderBy('created_at', 'desc') 
            ->get();
        $threads = $messages->groupBy(function ($message) use ($user) {
            $otherUserId = $message->sender_id === $user->id ? $message->receiver_id : $message->sender_id;
            return $message->listing_id . '-' . $otherUserId;
        });
         $chatThreads = $threads->map(function ($thread) use ($user) {
            $lastMessage = $thread->first(); 
            $otherUser = $lastMessage->sender_id === $user->id ? $lastMessage->receiver : $lastMessage->sender;
        
            return [
                'user' => $otherUser,
                'listing_id' => $lastMessage->listing_id,
                'message' => $lastMessage,
            ];
        })->values();
        return $chatThreads;
    }
    public function sendQuotation($request)
    {
        if(session()->has('currency_code')):
            $symble = session('currency_code');
        else:
            $symble = 'USD';
        endif;
        $quotation = new Quotation();
        $user = auth()->user();
        $listingId = Listing::where('slug', $request['slug'])->pluck('id')->first();
        $receiver_id = Listing::where('slug', $request['slug'])->pluck('user_id')->first();
        $request['checkindate'] = $request['checkin_date'];
        $request['checkoutdate'] = $request['checkout_date'];
        $request['id'] = $listingId;
        $price = bookingPrice($request);
        
        $quotation->user_id = $user->id;
        $quotation->listing_id =  $listingId;
        $quotation->checkin = $request['checkin_date'];
        $quotation->checkout = $request['checkout_date'];
        if(isset($request['half_day-2']) && !empty($request['half_day-2'])){
            $quotation->net_amount = $price['oneHalfDayPrice'];
            $quotation->sub_total = $price['oneHalfDayPrice'];
            $quotation->total = $price['oneHalfDayPrice']; 
        }
        else{
            $quotation->net_amount = $price['price'];
            $quotation->sub_total = $price['totalAmount'];
            $quotation->total = $price['totalAmount']; 
        }
        $quotation->service_fee = $price['servive_fee'];
        $quotation->currency = $symble;
        $quotation->status = 'Pending';
        if($quotation->save())
        {
            $message = Message::create([
                'sender_id' => auth()->id(),
                'receiver_id' => $receiver_id,
                'listing_id' => $listingId,
                'message' => $request['messages'],
            ]);
            return response()->json([
                'status' => 'success',
            ]);
        }

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