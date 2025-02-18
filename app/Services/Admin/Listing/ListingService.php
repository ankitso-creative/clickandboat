<?php
namespace App\Services\Admin\Listing;
use App\Repositories\Admin\Listing\ListingRepository;
class ListingService{
    protected $repository;
    public function __construct()
    {
        $this->repository = new ListingRepository();
    }
    public function storeGeneralSettings($request)
    {
        return $this->repository->storeGeneralSettings($request);

    }
    public function allListing()
    {
        return $this->repository->allListing();

    }
    public function editGeneralSettings($id)
    {
        return $this->repository->editGeneralSettings($id);

    }
    public function updateGeneralSettings($request,$id)
    {
        return $this->repository->updateGeneralSettings($request,$id);

    }
    public function listingDelete($id)
    {
        return $this->repository->listingDelete($id);

    }
    public function uploadImage($request,$id)
    {
        return $this->repository->uploadImage($request,$id);

    }
    public function removeImage($request)
    {
        return $this->repository->removeImage($request);
    }
    public function uploadCoverImage($request,$id)
    {
        return $this->repository->uploadCoverImage($request,$id);
    }
    public function changeStatus($request)
    {
        return $this->repository->changeStatus($request);
    }
}