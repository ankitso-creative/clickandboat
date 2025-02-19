<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\Blog\BlogStoreRequest;
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
        $active = 'blog';
        return view('admin.blog.index',compact('active'));
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
        $this->service->store($request);
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
