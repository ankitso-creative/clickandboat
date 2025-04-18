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
    public function edit($id)
    {
        $active = 'booking';
        $results =  $this->service->editBooking($id);
        return view('boatowner.bookingedit',compact('active','results'));
    }
    public function update(Request $request,$id)
    {
        $active = 'booking';
        $result =  $this->service->updateBooking($request,$id);
        if($result):
            return redirect()->route('boatowner.booking.index')->with('success', 'Order updated successfully!'); 
         else:
             session()->flash('error', 'There was an error with your updation.');
             return redirect()->route('boatowner.booking.index');  
         endif;
    }
} 
