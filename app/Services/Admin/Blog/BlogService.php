<?php
namespace App\Services\Admin\Blog;

use App\Repositories\Admin\Blog\BlogRepository;

class BlogService{

    protected $repostiry;
    public function __construct()
    {
        $this->repostiry = new BlogRepository();
    }
    public function store($request)
    {
        return $this->repostiry->store($request);
    }
}