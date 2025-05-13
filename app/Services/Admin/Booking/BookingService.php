<?php
namespace App\Services\Admin\Booking;

use App\Repositories\Admin\Booking\BookingRepository;

class BookingService{

    protected $repostiry;
    public function __construct()
    {
        $this->repostiry = new BookingRepository();
    }
    public function allBlogs($request)
    {
        return $this->repostiry->allBlogs($request);
    }
    public function allBookings()
    {
        return $this->repostiry->allBookings();
    }
    
}