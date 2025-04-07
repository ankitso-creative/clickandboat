<?php
namespace App\Repositories\Admin\Location;
use App\Models\Admin\Location;

class LocationRepository
{
    public function allLocations($request)
    {
        $blog = Location::when($request->has('name') && !empty($request->name), function ($query) use ($request) {
            $name = $request->name; 
            return $query->where('name', $name); 
        })
        ->when($request->has('language') && !empty($request->language), function ($query) use ($request) {
            $language = $request->language; 
            return $query->where('language', $language); 
        })
        ->paginate(9);
        return $blog;
    }
    public function store($request)
    {
        $blog = new Location();
        $blog->name = $request['name'];
        $blog->description = $request['description'];
        $blog->description_for_home_pape = $request['description_for_home_pape'];
        $blog->language = $request['language'];
        if($blog->save()):
            self::uploadImage($request['banner_image'],$blog->id);
            return true;
        else:
            return false;
        endif;
    }
    public function locationEdit($id)
    {
        return Location::with('media')->find($id);
    }
    
    public function locationUpdate($request,$id)
    {
        $blog = Location::find($id);
        $blog->name = $request['name'];
        $blog->description = $request['description'];
        $blog->description_for_home_pape = $request['description_for_home_pape'];
        $blog->language = $request['language'];
        if($blog->update()):
            if(isset($request['banner_image']) && $request['banner_image']) {
                self::uploadImage($request['banner_image'],$blog->id);
            }
            return true;
        else:
            return false;
        endif;
    }
    public function blogDestroy($id)
    {
        $blog = Location::find($id);
        if($blog->delete()):
            session()->flash('success', 'Location deleted successfully.');
            return response()->json([
                'success' => true, 
                'url' =>route('admin.location.index')
            ]);
        else:
            session()->flash('success', 'There was an error deleting the location. Please try again.');
            return response()->json([
                'success' => true, 
                'url' =>route('admin.location.index')
            ]); 
        endif;
    }
    public function changeStatus($request)
    {
        $id = $request['id'];
        $blog = Location::where('id',$id)->first();
        $blog->status = $request['value'];
        $blog->update();
        return $blog;
    }
   
    public function uploadImage($request,$id)
    {
        $blog = Location::find($id);
        if ($blog->hasMedia('location_image')) {
            $blog->getMedia('location_image')->each(function ($media) {
                $media->delete();  
            });
        }
        $media = $blog->addMediaFromRequest('banner_image')->toMediaCollection('location_image','blog_images'); 
        return $media;
    }
}