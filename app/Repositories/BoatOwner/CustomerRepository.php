<?php 
namespace App\Repositories\BoatOwner;

use App\Models\Admin\Booking;
use App\Models\User;

class CustomerRepository
{
    public function allCustomer()
    {
        $user = auth()->user();
        $listings = $user->listings;
        $bookings = [];
        foreach ($listings as $listing) {
            $bookings = array_merge($bookings, $listing->orders->toArray());
        }
        $uniqueUserIds = collect($bookings)->pluck('user_id')->unique()->values();
        $users = User::whereIn('id', $uniqueUserIds)->get();
        return $users;
    }
    
}