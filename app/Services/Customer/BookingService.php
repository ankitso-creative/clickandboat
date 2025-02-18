<?php
namespace App\Services\Customer;
use App\Repositories\Customer\ProfileRepository;
class BookingService{
    protected $repository;
    public function __construct()
    {
        $this->repository = new ProfileRepository();
    }
    public function updateProfile($request)
    {
        return $this->repository->updateProfile($request);
    }
    public function passwordUpdate($request)
    {
        return $this->repository->passwordUpdate($request);
    }
    public function uploadImage($request)
    {
        return $this->repository->uploadImage($request);
    }
}
?>