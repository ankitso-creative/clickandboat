<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class BookingController extends Controller
{
    public function index()
    {
        $active = 'booking';
        return view('customer.booking',compact('active'));
    }
   
    public function paymentConfirm()
    {
        return view('front.paymentconfirm');
    }
}
