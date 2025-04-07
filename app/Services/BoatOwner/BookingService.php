<?php 
namespace App\Services\BoatOwner;
use App\Repositories\BoatOwner\BookingRepository;
class BookingService {
    protected $repository;
    public function __construct()
    {
        $this->repository = new BookingRepository();
    }
    public function allBooking()
    {
        return $this->repository->allBooking();
    }
}