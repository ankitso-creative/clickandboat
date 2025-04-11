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
    public function allBlogs()
    {
        return $this->repository->allBlogs();
    }
    public function categories()
    {
        return $this->repository->categories();
    }
    public function locations()
    {
        return $this->repository->locations();
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
    public function getQuotationData($request)
    {
        return $this->repository->getQuotationData($request);
    }
    public function allListingData()
    {
        return $this->repository->allListingData();
    }
    public function allLocationData()
    {
        return $this->repository->allLocationData();
    }
    public function searchListing($request)
    {
        return $this->repository->searchListing($request);
    }
    public function singleBlog($slug)
    {
        return $this->repository->singleBlog($slug);
    }
    public function singleArea($slug)
    {
        return $this->repository->singleArea($slug);
    }
    public function allFaqs($request)
    {
        return $this->repository->allFaqs($request);
    }
    public function relatedBlog($id)
    {
        return $this->repository->relatedBlog($id);
    }
    public function submitRequest($request)
    {
        return $this->repository->submitRequest($request);
    }
}
?>