<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Services\Customer\BookingService;

class BookingController extends Controller
{
    protected $service;
    public function __construct()
    {
        $this->service = new BookingService();
    }
    public function index()
    {
        $active = 'booking';
        $results = $this->service->bookingAll();
        return view('customer.booking',compact('active','results'));
    }
   
    public function paymentConfirm()
    {
        return view('front.paymentconfirm');
    }
}
