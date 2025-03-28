<?php
namespace App\Services\Admin\Location;

use App\Repositories\Admin\Location\LocationRepository;

class LocationService{

    protected $repostiry;
    public function __construct()
    {
        $this->repostiry = new LocationRepository();
    }
    public function allLocations($request)
    {
        return $this->repostiry->allLocations($request);
    }
    public function store($request)
    {
        return $this->repostiry->store($request);
    }
    public function locationEdit($id)
    {
        return $this->repostiry->locationEdit($id);
    }
    
    public function locationUpdate($request,$id)
    {
        return $this->repostiry->locationUpdate($request,$id);
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