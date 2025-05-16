<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\Message\MessageRequest;
use App\Http\Requests\Customer\Message\QuotationRequest;
use App\Models\Admin\Listing;
use App\Models\Admin\Quotation;
use App\Models\User;
use Illuminate\Http\Request;
use App\Services\Customer\ChatService;
use Illuminate\Support\Facades\Crypt;

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
        $active = 'support';
        $userAgent = request()->header('User-Agent');
        $isMobile = preg_match('/Mobile|Android|iPhone|iPad|iPod/i', $userAgent);
        if(count($usersWithLastMessage)):
            if($isMobile):
                return view('customer.support', compact('active', 'usersWithLastMessage','isMobile'));
            else:
                $slug = Listing::where('id', $usersWithLastMessage[0]['listing_id'])->value('slug');
                return redirect()->route('customer.message', $slug)->with('success', 'Order updated successfully!'); 
            endif;   
        else:
            return view('customer.support', compact('active', 'usersWithLastMessage','isMobile'));
        endif;
    }

    public function message($slug)
    {
        $userAgent = request()->header('User-Agent');
        $isMobile = preg_match('/Mobile|Android|iPhone|iPad|iPod/i', $userAgent);
        $usersWithLastMessage = $this->service->usersWithLastMessage();
        $active = 'support';
        $listing = Listing::where('slug', $slug)->first();
        $receiver_id = $listing->user_id;
        $listingId = $listing->id;
        $sender = auth()->user();
        $receiver = User::find($receiver_id);
        $replies  = $this->service->fetchMessages($receiver_id,$listingId);
        $quotation = Quotation::where('listing_id',$listingId)->where('user_id',$sender->id)->latest()->first();
        $quotationID = '';
        if($quotation)
        {
            $quotationID = Crypt::encrypt($quotation->id);
        }
        return view('customer.message',compact('active','receiver_id','replies','sender','receiver','slug','quotation','listing','quotationID','usersWithLastMessage','isMobile'));
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
    public function sendQuotation(QuotationRequest $request)
    {
        $request = $request->all();
        return $this->service->sendQuotation($request);
    }
    
}
