<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\Blog\BlogStoreRequest;
use App\Http\Requests\Admin\Blog\BlogUpdateRequest;
use App\Services\Admin\Blog\BlogService;
class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $service;
    public function __construct()
    {
        $this->service = new BlogService;
    }
    public function index()
    {
        $results = $this->service->allBlogs();
        $active = 'blog';
        return view('admin.blog.index',compact('active','results'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $active = 'blog';
        return view('admin.blog.add',compact('active'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BlogStoreRequest $request)
    {
        $request = $request->all();
        $result = $this->service->store($request);
        if($result):
           return redirect()->route('admin.blog.index')->with('success', 'Blog created successfully!'); 
        else:
            session()->flash('error', 'There was an error with your submission.');
            return redirect()->route('admin.blog.index');  
        endif;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $active = 'blog';
        $result = $this->service->blogEdit($id);
        return view('admin.blog.edit',compact('active','result'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BlogUpdateRequest $request, string $id)
    {
        $request = $request->all();
        $result = $this->service->blogUpdate($request,$id);
        if($result):
           return redirect()->route('admin.blog.index')->with('success', 'Blog created successfully!'); 
        else:
            session()->flash('error', 'There was an error with your submission.');
            return redirect()->route('admin.blog.index');  
        endif;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $result = $this->service->blogDestroy($id);
    }
    public function changeStatus(Request $request)
    {
       return $this->service->changeStatus($request);
    }
    public function commentStatus(Request $request)
    {
       return $this->service->commentStatus($request);
    }
    public function blogComments($blogId)
    {
        $active = 'blog';
        $results = $this->service->blogComments($blogId);
        return view('admin.blog.comments',compact('active','results'));
    }
}
