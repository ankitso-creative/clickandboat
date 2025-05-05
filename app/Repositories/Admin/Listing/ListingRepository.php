<?php
namespace App\Repositories\Admin\Listing;
use App\Models\Admin\Listing;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Support\Facades\Storage;


class ListingRepository{
    public function allListing()
    {
        return Listing::with('user')->paginate(10);
    }
    public function storeGeneralSettings($request)
    {
        $listing = new Listing();
        $listing->user_id = $request['user_id'];
        $listing->type = $request['type'];
        $listing->harbour = $request['harbour'];
        $listing->city = $request['city'];
        $listing->manufacturer = $request['manufacturer'];
        $listing->model = $request['model'];
        $listing->skipper = $request['skipper'];
        $listing->capacity = $request['capacity'];
        $listing->length = $request['length'];
        $listing->company_name = $request['company_name'];
        $listing->website = $request['website'];
        $listing->boat_name = $request['boat_name'];
        $listing->title = $request['title'];
        $listing->onboard_capacity = $request['onboard_capacity'];
        $listing->cabins = $request['cabins'];
        $listing->berths = $request['berths'];
        $listing->bathrooms = $request['bathrooms'];
        $listing->construction_year = $request['construction_year'];
        $listing->fuel = $request['fuel'];
        $listing->renovated = $request['renovated'];
        $listing->speed = $request['speed'];
        if($listing->save()):
            $listing->description()->UpdateOrCreate(['listing_id' => $listing->id, 'language'  => 'en'],[
                'listing_id' => $listing->id,
                'description'  => $request['description'],
                'language'  => 'en',
            ]);
            return redirect()->route('admin.listings',$listing->id)->with('success', 'Your general details added successfully!'); 
        endif;
    }
    public function editGeneralSettings($id)
    {
        $result = Listing::where('id', $id)->with(['price','booking','otherListingSetting','equipment'])->first();
        if(!$result)
        {
            $result = new Listing();
        }
        return $result;
    }
    public function updateGeneralSettings($request,$id)
    {
        $listing = Listing::where('id', $id)->with(['price','booking','otherListingSetting','equipment','discount'])->first();
        if($request['s']=='general')
        {
            $listing->user_id = $request['user_id'];
            $listing->type = $request['type'];
            $listing->harbour = $request['harbour'];
            $listing->city = $request['city'];
            $listing->professional = $request['professional'];
            $listing->manufacturer = $request['manufacturer'];
            $listing->model = $request['model'];
            $listing->skipper = $request['skipper'];
            $listing->capacity = $request['capacity'];
            $listing->length = $request['length'];
            $listing->company_name = $request['company_name'];
            $listing->website = $request['website'];
            $listing->boat_name = $request['boat_name'];
            $listing->title = $request['title'];
            $listing->description = $request['description'];
            $listing->onboard_capacity = $request['onboard_capacity'];
            $listing->cabins = $request['cabins'];
            $listing->berths = $request['berths'];
            $listing->bathrooms = $request['bathrooms'];
            $listing->construction_year = $request['construction_year'];
            $listing->fuel = $request['fuel'];
            $listing->renovated = $request['renovated'];
            $listing->speed = $request['speed'];
            if($listing->update()):
                return redirect()->route('admin.listings',$listing->id.'#image')->with('success', 'Your general details updated successfully!'); 
            endif;
        }
        elseif($request['s']=='price')
        {
            $listing->fuel_Include = $request['fuel_Include'];
            $listing->fuel_price = $request['fuel_price'];
            $listing->skipper_include = $request['skipper_include'];
            $listing->skipper_price = $request['skipper_price'];
            $listing->update();
            $seasonPrices = $request['season_price'];
            if($seasonPrices):
                foreach($seasonPrices as $seasonPrice):
                    if($seasonPrice['from'] && $seasonPrice['price'] )
                    {
                        $seasonPriceModel = $listing->seasonPrice()->UpdateOrCreate(['listing_id' => $listing->id, 'name' => $seasonPrice['name']],[
                            'listing_id' => $listing->id,
                            'name' => $seasonPrice['name'],
                            'from'  => isset($seasonPrice['from']) ? json_encode($seasonPrice['from']) : '',
                            'price'  => $seasonPrice['price'],
                        ]);
                        if($seasonPriceModel->id)
                        {
                            $array = [
                                'listing_id' => $listing->id,
                                'season_price_id' =>  $seasonPriceModel->id,
                                'over_night_price' => $seasonPrice['over_night_price'],
                                'one_half_day' => $seasonPrice['one_half_day_price'],
                                'two_day'  => $seasonPrice['two_day_price'],
                                'three_day'  => $seasonPrice['three_day_price'],
                                'four_day'  => $seasonPrice['four_day_price'],
                                'five_day'  => $seasonPrice['five_day_price'],
                                'six_day'  => $seasonPrice['six_day_price'],
                                'one_week' => $seasonPrice['one_week_price'],
                            ];
                            $listing->price()->UpdateOrCreate(['listing_id' => $listing->id,'season_price_id' =>  $seasonPriceModel->id],$array);
                        }
                    }
                endforeach;
            endif;
           
            return redirect()->route('admin.listings',$listing->id.'#price')->with('success', 'Your price details saved successfully!'); 
        }
        elseif($request['s']=='booking')
        {
            $listing->booking()->UpdateOrCreate(['listing_id' => $listing->id],[
                'listing_id' => $listing->id,
                'cancellation_conditions'  => $request['cancellation_conditions'],
                'check_in' => $request['check_in'],
                'check_out'  => $request['check_out'],
                'check_in_rental'  => $request['check_in_rental'],
                'check_out_rental'  => $request['check_out_rental'],
                'fuel_cost'  => $request['fuel_cost'],
                'boat_licence'  => $request['boat_licence'],
                'night_fees' => $request['night_fees'],
            ]);
            return redirect()->route('admin.listings',$listing->id.'#booking')->with('success', 'Your booking settings saved successfully!'); 
        }
        elseif($request['s']=='other')
        {
            $listing->otherListingSetting()->UpdateOrCreate(['listing_id' => $listing->id],[
                'listing_id' => $listing->id,
                'engine_type'  => $request['engine_type'],
                'horsepower' => $request['horsepower'],
                'width'  => $request['width'],
                'draft'  => $request['draft'],
                'offshore'  => $request['offshore'],
                'crew_members'  => $request['crew_members'],
                'horsepower_tender' => $request['horsepower_tender'],
            ]);
            return redirect()->route('admin.listings',$listing->id.'#other')->with('success', 'Your listing settings saved successfully!'); 
        }
        elseif($request['s']=='equipment')
        {
            $listing->equipment()->UpdateOrCreate(['listing_id' => $listing->id],[
                'listing_id' => $listing->id,
                'outdoor_equipment'  => isset($request['outdoor_equipment']) ? json_encode($request['outdoor_equipment']) : '',
                'extra_comfrot' => isset($request['extra_comfrot']) ? json_encode($request['extra_comfrot']) : '',
                'navigation_equipment'  => isset($request['navigation_equipment']) ? json_encode($request['navigation_equipment']) : '',
                'kitchen'  => isset($request['kitchen']) ? json_encode($request['kitchen']) : '',
                'leisure_activities'  => isset($request['leisure_activities']) ? json_encode($request['leisure_activities']) : '',
                'onboard_energy'  => isset($request['onboard_energy']) ? json_encode($request['onboard_energy']) : '',
                'water_sports' => isset($request['water_sports']) ? json_encode($request['water_sports']) : '',
            ]);
            return redirect()->route('admin.listings',$listing->id.'#equipment')->with('success', 'Your listing equipments saved successfully!'); 
        }
        elseif($request['s']=='discount')
        {
            $listing->discount()->UpdateOrCreate(['listing_id' => $listing->id],[
                'listing_id' => $listing->id,
                'first_booking_discount'  => $request['first_booking_discount'],
                'early_bird_discount' => serialize($request['early_booking']),
                'last_minute_booking'  => serialize($request['last_min_booking']), 
                'length_of_stay_discounts'  => serialize($request['length_stay_dis']) ,
                'custom_discounts'  => serialize($request['custom_discount']),
            ]);
            return redirect()->route('admin.listings',$listing->id.'#discounts')->with('success', 'Your listing discount saved successfully!'); 
        }
        elseif($request['s']=='calendar')
        {
            if($request['calendar'])
            {
                $listing->calendar()->delete();
                foreach($request['calendar'] as $calendar):
                    $listing->calendar()->create([
                        'listing_id' => $listing->id,
                        'from_date'  => $calendar['from_date'],
                        'from_to' => $calendar['from_to'],
                        'reason'  => $calendar['reason'], 
                    ]);
                endforeach;
            }
            return redirect()->route('admin.listings',$listing->id.'#calendar')->with('success', 'Your listing calendar saved successfully!'); 
        }
        else
        {
            return redirect()->route('home'); 
        }
    }
    public function listingDelete($id)
    {
        $listing = Listing::find($id);
        $listing->price()->delete(); // If the user has a profile
        $listing->booking()->delete(); 
        $listing->otherListingSetting()->delete(); 
        $listing->equipment()->delete(); 
        $listing->discount()->delete(); 
        $listing->calendar()->delete(); 
        $listing->delete(); 
        session()->flash('success', 'There was an error deleting the user. Please try again.');
        return response()->json([
            'success' => true, 
            'url' =>route('admin.boatowner')
        ]); 
    }
    public function uploadImage($request,$id)
    {
        $listing = Listing::find($id);
        $media = $listing->addMediaFromRequest('file')->toMediaCollection('listing_gallery','listing'); 
        return response()->json([
            'message' => 'Image uploaded successfully',
            'data' => [
                'id' => $media->id,
                'url' => $media->getUrl()  // URL of the uploaded image
            ]
        ]);
    }
    public function removeImage($request)
    {
        $imageId = $request['id'];
        $image = Media::findOrFail($imageId);
        $filePath = $image->getPath(); 
        $image->delete();
        if (Storage::exists($filePath)) {
            Storage::delete($filePath);
        }
        return response()->json([
            'success' => 'success',
            'message' => 'Image deleted successfully',
        ]);
    }
    public function uploadCoverImage($request,$id)
    {
        $listing = Listing::find($id);
        if ($listing->hasMedia('cover_images')) {
            $listing->getMedia('cover_images')->each(function ($media) {
                $media->delete();  // Delete the old image(s)
            });
        }
        $media = $listing->addMediaFromRequest('image')->toMediaCollection('cover_images','cover_images'); 
        return response()->json([
            'success' => 'success',
            'imageUrl' => $media->getUrl(),
        ]);
    }
    public function changeStatus($request)
    {
        $id = $request['id'];
        $listing = Listing::where('id',$id)->first();
        $listing->status = $request['value'];
        return $listing->update();
    }
}