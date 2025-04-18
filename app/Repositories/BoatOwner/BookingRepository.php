<?php 
namespace App\Repositories\BoatOwner;

use App\Models\Admin\Booking;
use App\Models\Order;
use App\Models\User;

class BookingRepository
{
    public function allBooking()
    {
        $user = auth()->user();
        $listings = $user->load('listings.orders.user');  // Eager load 'orders' and their related 'user'
        $bookings = [];
        foreach ($listings->listings as $listing) 
        {
            foreach ($listing->orders as $order) 
            {
                $order->userDetails = $order->user;
                $order->listingDetails = $listing;
                $bookings[] = $order;
            }
        }
        return $bookings;
    }
    public function editBooking($id)
    {
        return Order::find($id);
    }
    public function updateBooking($request,$id)
    {
        $order = Order::find($id);
        $order->cancel_reason = $request['cancel_reason'];
        $order->cancel_message = $request['cancel_message'];
        $order->payment_status = $request['payment_status'];
        if($order->update()):
            return true;
        else:
            return false;
        endif;
    }
    
}