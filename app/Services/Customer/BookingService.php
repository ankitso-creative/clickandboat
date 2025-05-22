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
    public function editBooking($id)
    {
        return $this->repository->editBooking($id);
    }
    public function updateBooking($request,$id)
    {
        return $this->repository->updateBooking($request,$id);
    }
    public function storeReview($request)
    {
        return $this->repository->storeReview($request);
    }
}
?>