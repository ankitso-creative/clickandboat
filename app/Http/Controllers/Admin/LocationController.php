<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\Location\LocationStoreRequest;
use App\Http\Requests\Admin\Location\LocationUpdateRequest;
use App\Models\Admin\Language;
use App\Services\Admin\Location\LocationService;
class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $service;
    public function __construct()
    {
        $this->service = new LocationService;
    }
    public function index(Request $request)
    {
        //$request =  $request->all();
        $results = $this->service->allLocations($request);
        $languages = selectOption('languages','name','code','',array('status','1'));
        $active = 'location';
        return view('admin.location.index',compact('active','results','languages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $languages = Language::where('status','1')->get();
        $active = 'location';
        return view('admin.location.add',compact('active','languages'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LocationStoreRequest $request)
    {
        $request = $request->all();
        $result = $this->service->store($request);
        if($result):
           return redirect()->route('admin.location.index')->with('success', 'Location created successfully!'); 
        else:
            session()->flash('error', 'There was an error with your submission.');
            return redirect()->route('admin.location.index');  
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
        $active = 'location';
        $languages = Language::where('status','1')->get();
        $result = $this->service->locationEdit($id);
        return view('admin.location.edit',compact('active','result','languages'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LocationUpdateRequest $request, string $id)
    {
        $request = $request->all();
        $result = $this->service->locationUpdate($request,$id);
        if($result):
           return redirect()->route('admin.location.index')->with('success', 'Location created successfully!'); 
        else:
            session()->flash('error', 'There was an error with your submission.');
            return redirect()->route('admin.location.index');  
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
    
}
