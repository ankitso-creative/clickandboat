<?php
namespace App\Services\Customer;
use App\Repositories\Customer\ProfileRepository;
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
    public function uploadImage($request)
    {
        return $this->repository->uploadImage($request);
    }
    public function favouriteItems()
    {
        return $this->repository->favouriteItems();
    }
    public function accountDelete($request)
    {
        return $this->repository->accountDelete($request);
    }
}
?>