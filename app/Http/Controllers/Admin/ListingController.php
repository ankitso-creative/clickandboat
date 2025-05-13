<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Listing\StoreListingRequest;
use App\Http\Requests\Admin\Listing\UploadImageRequest;
use App\Models\Admin\Listing;
use Illuminate\Http\Request;
use App\Services\Admin\Listing\ListingService;
class ListingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $service;
    public function __construct()
    {
        $this->service = new ListingService();
    }
    public function index()
    {
        $active = 'listing';
        $listings = $this->service->allListing();
        return view('admin.listing.index', compact('active','listings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id = null)
    {
        $active = 'listing';
        $listing = new Listing();
        $users = selectOption('users','name','id','',['role' , 'boatowner']);
        if($id) 
        {
            $listing = $this->service->editGeneralSettings($id);
            $users = selectOption('users','name','id',$listing->user_id,['role', 'boatowner']);
        } 
        return view('admin.listing.add', compact('active','listing','users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeGeneralSettings(StoreListingRequest $request,$id = null)
    {
        $request = $request->all();
        if($id) 
        {
           return $this->service->updateGeneralSettings($request,$id);
        } 
        else 
        {
            return $this->service->storeGeneralSettings($request);
            // if($result):
            //     return redirect()->route('admin.listing')->with('success', 'Boat owner created successfully!'); 
            // endif;
        }
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
        return $this->service->listingDelete($id);
    }
    public function uploadImage(UploadImageRequest $request, $id)
    {
        $request = $request->all();
        return $this->service->uploadImage($request,$id);
    }
    public function removeImage(Request $request)
    {
        $request = $request->all();
        return $this->service->removeImage($request);
    }
    public function uploadCoverImage(Request $request, $id)
    {
        $request = $request->all();
        return $this->service->uploadCoverImage($request, $id);
    }
    public function changeStatus(Request $request)
    {
        $request = $request->all();
        return $this->service->changeStatus($request);
    }
    public function changeStatusFeatured(Request $request)
    {
        $request = $request->all();
        return $this->service->changeStatusFeatured($request);
    }
}
