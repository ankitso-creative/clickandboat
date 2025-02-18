<?php

namespace App\Http\Controllers\BoatOwner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        $active = 'booking';
        return view('boatowner.booking',compact('active'));
    }
} 
