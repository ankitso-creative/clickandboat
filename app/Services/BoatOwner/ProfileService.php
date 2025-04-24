<?php
namespace App\Services\BoatOwner;
use App\Repositories\BoatOwner\ProfileRepository;
class ProfileService{
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
    public function experienceUpdate($request)
    {
        return $this->repository->experienceUpdate($request);
    }
    public function companyUpdate($request)
    {
        return $this->repository->companyUpdate($request);
    }
    public function paymentUpdate($request)
    {
        return $this->repository->paymentUpdate($request);
    }
    public function accountDelete($request)
    {
        return $this->repository->accountDelete($request);
    }
    public function uploadImage($request)
    {
        return $this->repository->uploadImage($request);
    }
}
?>