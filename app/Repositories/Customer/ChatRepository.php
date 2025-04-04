<?php 
namespace App\Repositories\Customer;

use App\Events\Auth\ChatMessageSent;
use App\Models\Admin\Listing;
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
                            <small class="msg-time">10 Second Ago</small>
                        </div>
                    </div>
                </div>';
        return response()->json([
            'html' => $html,
            'status' => 'success',
        ]);
    }
    public function fetchMessages($receiver_id)
    {
        $messages = Message::where(function ($query) use ($receiver_id) {
            $query->where('sender_id', auth()->id())->where('receiver_id', $receiver_id);
        })->orWhere(function ($query) use ($receiver_id) {
            $query->where('sender_id', $receiver_id)->where('receiver_id', auth()->id());
        })->orderBy('created_at', 'asc')->get();
        return $messages;
    }
    public function seeAllMessage($request)
    {
        $receiver_id = $request['receiver_id'];
        $messages = Message::where(function ($query) use ($receiver_id) {
            $query->where('sender_id', auth()->id())->where('receiver_id', $receiver_id);
        })->orWhere(function ($query) use ($receiver_id) {
            $query->where('sender_id', $receiver_id)->where('receiver_id', auth()->id());
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
            
                $html .= '<li class="'.$class.'">
                    <div class="'.$sub_class.'">
                        <img src="'.$user_image.'">
                    <div class="msg-desc">
                        '.$message.'
                    </div>
                        <small>'.$reply['created_on'].'</small>
                    </div>
                </li>';
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
        $users = User::whereHas('sentMessages', function ($query) use ($user) {
            $query->where('receiver_id', $user->id);
        })
        ->orWhereHas('receivedMessages', function ($query) use ($user) {
            $query->where('sender_id', $user->id);
        })
        ->with(['sentMessages' => function ($query) use ($user) {
            $query->where('receiver_id', $user->id)
                ->orderBy('created_at', 'desc')
                ->limit(1);
        }, 'receivedMessages' => function ($query) use ($user) {
            $query->where('sender_id', $user->id)
                ->orderBy('created_at', 'desc')
                ->limit(1);
        }])
        ->get();
        $usersWithLastMessage = $users->map(function ($user) {
            $lastSentMessage = $user->sentMessages->first();
            $lastReceivedMessage = $user->receivedMessages->first();
            $lastMessage = null;
            if ($lastSentMessage && $lastReceivedMessage) {
                $lastMessage = $lastSentMessage->created_at > $lastReceivedMessage->created_at ? $lastSentMessage : $lastReceivedMessage;
            } elseif ($lastSentMessage) {
                $lastMessage = $lastSentMessage;
            } elseif ($lastReceivedMessage) {
                $lastMessage = $lastReceivedMessage;
            }
            return [
                'user' => $user,
                'message' => $lastMessage
            ];
        });
        return $usersWithLastMessage;
    }
}