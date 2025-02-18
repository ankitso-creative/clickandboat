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
    public function getBookingPrice($request)
    {
        return $this->repository->getBookingPrice($request);
    }
    public function getListingData()
    {
        return $this->repository->getListingData();
    }
}
?>