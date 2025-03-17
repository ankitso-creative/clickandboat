<?php
namespace App\Services\Front;

use App\Repositories\Front\AjaxRepository;

class AjaxService{
    protected $repository;
    public function __construct()
    {
        $this->repository = new AjaxRepository();
    }
    public function favorited($request)
    {
        return $this->repository->favorited($request);
    }
    
}
?>