<?php 
namespace App\Repositories\BoatOwner;

use App\Models\Admin\Booking;
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
    
}