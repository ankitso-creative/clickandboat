<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\Message\MessageRequest;
use App\Models\Admin\Listing;
use Illuminate\Http\Request;
use App\Services\Customer\ChatService;

class ChatController extends Controller
{
    protected $service ;
    public function __construct()
    {
        $this->service = new ChatService();
    }
    public function index()
    {
        $active = 'support';
        return view('customer.support',compact('active'));
    }
    public function message($slug)
    {
        $active = 'support';
        $receiver_id = Listing::where('slug', $slug)->pluck('user_id')->first();
        return view('customer.message',compact('active','receiver_id'));
    }
    public function sendMessage(MessageRequest $request)
    {
        return $this->service->sendMessage($request);
    }
    public function fetchMessages($receiver_id)
    {
        return $this->service->fetchMessages($receiver_id);
    }
}
