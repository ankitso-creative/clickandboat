<?php

namespace App\Http\Controllers\BoatOwner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\BoatOwner\BookingService;
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
        $results = $this->service->allBooking();
        return view('boatowner.booking',compact('active','results'));
    }
} 
