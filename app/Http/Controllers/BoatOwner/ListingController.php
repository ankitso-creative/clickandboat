<?php

namespace App\Http\Controllers\BoatOwner;

use App\Http\Controllers\Controller;
use App\Http\Requests\BoatOwner\Listing\UpdateListing;
use App\Http\Requests\BoatOwner\Listing\UploadImageRequest;
use App\Models\Admin\Category;
use App\Models\Admin\Language;
use App\Services\BoatOwner\ListingService;
use Illuminate\Http\Request;

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
        $results = $this->service->allListing();
        return view('boatowner.listing',compact('active','results'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $active = 'listing';
        $categories = Category::where('status','1')->with('media')->get();
        return view('boatowner.listingadd',compact('active','categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UpdateListing $request)
    {
        $request = $request->all();
        return $this->service->storeGeneralSettings($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }
    public function preview(string $id)
    {
        $listing = $this->service->editListing($id);
        if(!$listing):
            return redirect()->route('boatowner.listing');
        endif;
        $userAgent = request()->header('User-Agent');
        $isMobile = preg_match('/Mobile|Android|iPhone|iPad|iPod/i', $userAgent);
        if(session()->has('currency_code')):
            $symble = priceSymbol(session('currency_code'));
        else:
            $symble = priceSymbol('USD');
        endif;
       
        $calendarArray = '';
        if(!$listing)
        {
            return redirect()->route('home');
        }
        $equipments = $listing->equipment;
        $flatItems=[];
        $sixEquipments='';
        $viewEquipments='';
        $totalEquipments = 0;
        if($equipments):
            unset($equipments->id);
            unset($equipments->listing_id);
            unset($equipments->created_at);
            unset($equipments->updated_at);
            $equipments = $equipments->toArray();
            foreach ($equipments as $category => $itemsJson) 
            {
                $items = json_decode($itemsJson, true);
                if($items):
                    $flatItems = array_merge($flatItems, $items);
                endif;
            }
            $sixEquipments = array_slice($flatItems,0,6);
            $totalEquipments = count($flatItems);
            $viewEquipments = count($flatItems) - 6;
        endif;
        
        return view('boatowner.listingpreview',compact('listing','calendarArray','equipments','viewEquipments','sixEquipments','totalEquipments','symble','isMobile'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $categories = Category::where('status','1')->with('media')->get();
        $languages = Language::where('status','1')->get();
        $active = 'listing';
        $listing = $this->service->editListing($id);
        if(!$listing):
            return redirect()->route('boatowner.listing');
        endif;
        return view('boatowner.listingedit',compact('active','listing','languages','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateListing $request, $id)
    {
        $request = $request->all();
        return $this->service->updateListing($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function uploadImage(UploadImageRequest $request, $id)
    {
        $request = $request->all();
        return $this->service->uploadImage($request,$id);
    }
    public function uploadPlanImage(UploadImageRequest $request, $id)
    {
        $request = $request->all();
        return $this->service->uploadPlanImage($request,$id);
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
    public function search(Request $request)
    {
        $request = $request->all();
        return $this->service->searchListing($request);
    }
    public function changeStatus(Request $request)
    {
        $request = $request->all();
        return $this->service->changeStatus($request);
    }
    public function listingPublish($id)
    {
        return $this->service->listingPublish($id);
    }
}
