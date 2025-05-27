<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\BoatOwner\Booking\BookingRequest;
use App\Http\Requests\Customer\Profile\ReviewRequest;
use App\Models\Admin\Listing;
use App\Models\ListingReview;
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
    public function edit($id)
    {
        $active = 'booking';
        $results =  $this->service->editBooking($id);
        return view('customer.bookingedit',compact('active','results'));
    }
    public function update(BookingRequest $request,$id)
    {
        $active = 'booking';
        $result =  $this->service->updateBooking($request,$id);
        if($result):
            return redirect()->route('customer.booking.index')->with('success', 'Order updated successfully!'); 
         else:
             session()->flash('error', 'There was an error with your updation.');
             return redirect()->route('customer.booking.index');  
         endif;
    }
    public function addReview($slug)
    {
        $active = 'booking';
        $userId = auth()->id();
        $listing = Listing::where('slug',$slug)->first();
        $review = ListingReview::where('user_id',$userId)->where('listing_id',$listing->id)->first();
        return view('customer.review',compact('active','slug','review'));
    }
    public function submitReview(ReviewRequest $request)
    {
        $request = $request->all();
        $result =  $this->service->storeReview($request);
        if($result):
            return redirect()->route('customer.booking.index')->with('success', 'Review submitted successfully!'); 
        else:
            session()->flash('error', 'There was an error with your submission.');
            return redirect()->route('customer.booking.index');  
        endif;
    }
}
