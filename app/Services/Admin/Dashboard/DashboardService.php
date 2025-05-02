<?php
namespace App\Services\Admin\Dashboard;
use App\Repositories\Admin\Dashboard\DashboardRepository;
class DashboardService{
   protected $repository;
   public function __construct()
   {
      $this->repository = new DashboardRepository();
   }
   public function boatOwnerCount()
   {
      return $this->repository->boatOwnerCount();
   }
   public function customerCount()
   {
      return $this->repository->customerCount();
   }
   public function listingCount()
   {
      return $this->repository->listingCount();
   }
   public function bookingCount()
   {
      return $this->repository->bookingCount();
   }
}