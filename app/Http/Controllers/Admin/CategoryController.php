<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Category\CategoryStoreRequest;
use App\Http\Requests\Admin\Category\CategoryUpdateRequest;
use App\Services\Admin\Category\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $service;
    public function __construct()
    {
        $this->service = new CategoryService();
    }
    public function index()
    {  
        $results = $this->service->allCategory();
        $active = 'category';
        return view('admin.category.index',compact('active','results'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $active = 'category';
        return view('admin.category.add',compact('active'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryStoreRequest $request)
    {
        $request = $request->all();
        $result = $this->service->store($request);
        if($result):
           return redirect()->route('admin.category.index')->with('success', 'Category created successfully!'); 
        else:
            session()->flash('error', 'There was an error with your submission.');
            return redirect()->route('admin.category.index');  
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
        $active = 'category';
        $result = $this->service->categoryEdit($id);
        return view('admin.category.edit',compact('active','result'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryUpdateRequest $request, string $id)
    {
        $request = $request->all();
        $result = $this->service->categoryUpdate($request,$id);
        if($result):
           return redirect()->route('admin.category.index')->with('success', 'Category created successfully!'); 
        else:
            session()->flash('error', 'There was an error with your submission.');
            return redirect()->route('admin.category.index');  
        endif;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $result = $this->service->categoryDestroy($id);
    }
    public function changeStatus(Request $request)
    {
       return $this->service->changeStatus($request);
    }
}
