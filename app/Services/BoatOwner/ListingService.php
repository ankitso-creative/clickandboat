<?php
namespace App\Services\BoatOwner;
use App\Repositories\BoatOwner\ListingRepository;
class ListingService{
    protected $repository;
    public function __construct()
    {
        $this->repository = new ListingRepository();
    }
    public function allListing()
    {
        return $this->repository->allListing();
    }
    public function editListing($id)
    {
        return $this->repository->editListing($id);
    }
    public function updateListing($request, $id)
    {
        return $this->repository->updateListing($request, $id);
    }
    public function storeGeneralSettings($request)
    {
        return $this->repository->storeGeneralSettings($request);
    }
    public function uploadImage($request,$id)
    {
        return $this->repository->uploadImage($request,$id);
    }
    public function uploadPlanImage($request,$id)
    {
        return $this->repository->uploadPlanImage($request,$id);
    }
    public function removeImage($request)
    {
        return $this->repository->removeImage($request);
    }
    public function uploadCoverImage($request,$id)
    {
        return $this->repository->uploadCoverImage($request,$id);
    }
    public function searchListing($request)
    {
        $results = $this->repository->searchListing($request);
        $html ='';
        if(count($results)):
            foreach($results as $result):
                $image = $result->getFirstMediaUrl('cover_images');
                if(!$image):
                    $image = 'https://static1.clickandboat.com/v1/o/img/mask~dddc60cc1d.png';
                endif;
                $checked = '';
                if($result->status==1):
                    $checked = 'checked';
                endif;
                $html .='<div class="col-lg-4">
                    <div class="card list_edit_card" style="width: 18rem;">
                        <img class="card-img-top" src="'. $image.'" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-text bold">'.$result->boat_name.' - '. $result->type.' '. $result->manufacturer.' '. $result->model.' </h5>
                        </div>
                        <ul class="list-group list-group-flush">
                        <li class="list-group-item"><a href="'.route('boatowner.listing.edit', $result->id).'">Edit /</a> <a href="#">Delete /</a> <a href="#">Preview listing</a></li>
                        <li><div class="content active_inactive_btn">
                            <label class="switch m5">
                                <input type="checkbox" '.$checked.' class="change_status" Lid="'.$result->id.'"> 
                                <small></small>
                            </label>
                            </div>
                        </li>
                        </ul>
                    </div>
                </div>';
            endforeach;
            return response()->json([
                'success' => 'success',
                'html' => $html,
            ]);
        else:
            return response()->json([
                'success' => 'success',
                'html' => '<div class="col-lg-12"><p>No listings found</p></div>',
            ]);
        endif;
    }
    public function changeStatus($request)
    {
        return $this->repository->changeStatus($request);
    }
    public function listingPublish($id)
    {
        return $this->repository->listingPublish($id);
    }
}
?>