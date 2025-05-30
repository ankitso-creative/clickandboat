<?php
namespace App\Services\Admin\Blog;

use App\Repositories\Admin\Blog\BlogRepository;

class BlogService{

    protected $repostiry;
    public function __construct()
    {
        $this->repostiry = new BlogRepository();
    }
    public function allBlogs($request)
    {
        return $this->repostiry->allBlogs($request);
    }
    public function store($request)
    {
        return $this->repostiry->store($request);
    }
    public function blogEdit($id)
    {
        return $this->repostiry->blogEdit($id);
    }
    public function blogComments($blogId)
    {
        return $this->repostiry->blogComments($blogId);
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
    public function commentStatus($id)
    {
        return $this->repostiry->commentStatus($id);
    }
    public function changeOrderBlog($id)
    {
        return $this->repostiry->changeOrderBlog($id);
    }
}