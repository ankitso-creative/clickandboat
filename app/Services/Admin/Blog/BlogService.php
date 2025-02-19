<?php
namespace App\Services\Admin\Blog;

use App\Repositories\Admin\Blog\BlogRepository;

class BlogService{

    protected $repostiry;
    public function __construct()
    {
        $this->repostiry = new BlogRepository();
    }
    public function allBlogs()
    {
        return $this->repostiry->allBlogs();
    }
    public function store($request)
    {
        return $this->repostiry->store($request);
    }
    public function blogEdit($id)
    {
        return $this->repostiry->blogEdit($id);
    }
    public function blogUpdate($request,$id)
    {
        return $this->repostiry->blogUpdate($request,$id);
    }
    public function blogDestroy($id)
    {
        return $this->repostiry->blogDestroy($id);
    }
    public function changeStatus($id)
    {
        return $this->repostiry->changeStatus($id);
    }
}