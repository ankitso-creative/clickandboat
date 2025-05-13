<?php

namespace App\Http\Controllers\BoatOwner;

use App\Http\Controllers\Controller;
use App\Http\Requests\BoatOwner\Message\MessageRequest;
use App\Models\Admin\Listing;
use App\Models\Admin\Quotation;
use App\Models\User;
use Illuminate\Http\Request;
use App\Services\BoatOwner\ChatService;

class ChatController extends Controller
{
    protected $service ;
    public function __construct()
    {
        $this->service = new ChatService();
    }
    // public function index()
    // {
    //     $user = auth()->user();
    //     $users = User::whereHas('sentMessages', function ($query) use ($user) {
    //         $query->where('receiver_id', $user->id);
    //     })
    //     ->orWhereHas('receivedMessages', function ($query) use ($user) {
    //         $query->where('sender_id', $user->id);
    //     })
    //     ->get();
    //     dd($users);
    //     $active = 'support';
    //     return view('customer.support',compact('active','users'));
    // }
    public function index()
    {
        $usersWithLastMessage = $this->service->usersWithLastMessage();
        $postData[] = '';
        if($usersWithLastMessage):
            foreach($usersWithLastMessage as $userMessage):
                $user = $userMessage['user'];
                $message = $userMessage['message'];
                $listing = collect($user->listing)->filter(function($listing) use ($message) {
                    return $listing->id == $message['listing_id'];
                })->first();
            endforeach;
        endif;   
        
        $active = 'support';
        if(count($usersWithLastMessage)):
            return redirect()->route('boatowner.message', ['receiver_id' => $usersWithLastMessage[0]['user']['id'], 'slug' => $usersWithLastMessage[0]['listing']['slug']])->with('success', 'Order updated successfully!'); 
        else:
            return view('boatowner.support', compact('active', 'usersWithLastMessage'));
        endif;
    }

    public function message($receiver_id,$slug)
    {
        $usersWithLastMessage = $this->service->usersWithLastMessage();

        $active = 'support';
        $slug = $slug;
        $listing = Listing::where('slug', $slug)->first();
        $receiver_id = $receiver_id;
        $sender = auth()->user();
        $receiver = User::find($receiver_id);
        $replies  = $this->service->fetchMessages($receiver_id,$listing->id);
        $quotation = Quotation::where('listing_id',$listing->id)->where('user_id',$receiver_id)->first();
        return view('boatowner.message',compact('active','receiver_id','replies','sender','receiver','slug','quotation','listing','usersWithLastMessage'));
    }
    public function sendMessage(MessageRequest $request)
    {
        return $this->service->sendMessage($request);
    }
    public function seeAllMessage(Request $request)
    {
        $request = $request->all();
        return $this->service->seeAllMessage($request);
    }
    public function seeCountMessage(Request $request)
    {
        $request = $request->all();
        return $this->service->seeCountMessage($request);
    }
    public function fetchMessages($receiver_id)
    {
        return $this->service->fetchMessages($receiver_id);
    }
    public function spcialOfferSend(Request $request)
    {
        $request = $request->all();
        return $this->service->spcialOfferSend($request);
    }
    public function updateQuotation($id)
    {
        return $this->service->updateQuotation($id);
    }
    public function cancelQuotation($id)
    {
        return $this->service->cancelQuotation($id);
    }
}
