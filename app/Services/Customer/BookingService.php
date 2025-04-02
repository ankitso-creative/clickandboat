<?php
namespace App\Services\Customer;
use App\Repositories\Customer\BookingRepository;
class BookingService{
    protected $repository;
    public function __construct()
    {
        $this->repository = new BookingRepository();
    }
    public function bookingAll()
    {
        return $this->repository->bookingAll();
    }
}
?>