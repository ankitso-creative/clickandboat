<?php
namespace App\Services\Front;
use App\Repositories\Front\PageRepository;
class PageService{
    protected $repository;
    public function __construct()
    {
        $this->repository = new PageRepository();
    }
    public function singleBoat($slug)
    {
        return $this->repository->singleBoat($slug);
    }
    public function singleBoatDetails($city,$type,$slug)
    {
        return $this->repository->singleBoatDetails($city,$type,$slug);
    }
    public function getBookingPrice($request)
    {
        return $this->repository->getBookingPrice($request);
    }
    public function getListingData()
    {
        return $this->repository->getListingData();
    }
    public function allListingData()
    {
        return $this->repository->allListingData();
    }
    public function searchListing($request)
    {
        return $this->repository->searchListing($request);
    }
}
?>