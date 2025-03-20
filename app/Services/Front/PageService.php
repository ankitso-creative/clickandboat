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
    public function blogs()
    {
        return $this->repository->blogs();
    }
    public function singleBoatDetails($city,$type,$slug)
    {
        return $this->repository->singleBoatDetails($city,$type,$slug);
    }
    public function locationCategry($type)
    {
        return $this->repository->locationCategry($type);
    }
    public function locationListing($city)
    {
        return $this->repository->locationListing($city);
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
    public function singleBlog($slug)
    {
        return $this->repository->singleBlog($slug);
    }
    public function relatedBlog($id)
    {
        return $this->repository->relatedBlog($id);
    }
}
?>