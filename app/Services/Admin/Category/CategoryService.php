<?php
namespace App\Services\Admin\Category;

use App\Repositories\Admin\Category\CategoryRepository;

class CategoryService{

    protected $repostiry;
    public function __construct()
    {
        $this->repostiry = new CategoryRepository();
    }
    public function allCategory()
    {
        return $this->repostiry->allCategory();
    }
    public function store($request)
    {
        return $this->repostiry->store($request);
    }
    public function categoryEdit($id)
    {
        return $this->repostiry->categoryEdit($id);
    }
    
    public function categoryUpdate($request,$id)
    {
        return $this->repostiry->categoryUpdate($request,$id);
    }
    public function categoryDestroy($id)
    {
        return $this->repostiry->categoryDestroy($id);
    }
    public function changeStatus($id)
    {
        return $this->repostiry->changeStatus($id);
    }
    
}