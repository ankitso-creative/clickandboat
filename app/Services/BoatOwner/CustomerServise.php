<?php 
namespace App\Services\BoatOwner;
use App\Repositories\BoatOwner\CustomerRepository;
class CustomerServise {
    protected $repository;
    public function __construct()
    {
        $this->repository = new CustomerRepository();
    }
    public function allCustomer()
    {
        return $this->repository->allCustomer();
    }
}