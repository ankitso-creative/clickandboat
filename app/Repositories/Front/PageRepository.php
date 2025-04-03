<?php
    namespace App\Repositories\Front;

    use App\Events\Front\RequestSubmitted;
    use App\Models\Admin\Blog;
use App\Models\Admin\Category;
use App\Models\Admin\Listing;
    use App\Models\Admin\Location;
    use App\Models\Admin\Price;
    use Carbon\Carbon;
    use Illuminate\Support\Facades\Session;

    class PageRepository
    {
        public function singleBoat($slug)
        {
            $listing = Listing::with(['price'])->where('slug',$slug)->where('status','1')->first();
            if($listing):
                Session::put('listingID', $listing->id);
            endif;
            return $listing;
        }
        public function blogs()
        {
            $blogs = Blog::where('status','1')->orderBy('created_at', 'desc')->limit(3)->get();
            return $blogs;
        }
        public function allBlogs()
        {
            $blogs = Blog::where('status','1')->orderBy('created_at', 'desc')->paginate(7);
            return $blogs;
        }
        public function categories()
        {
            $category = Category::where('status','1')->with('media')->get();
            return $category;
        }
        public function singleBoatDetails($city,$type,$slug)
        {
            $listing = Listing::with(['price','seasonPrice','booking','calendar'])->where('slug',$slug)->where('city',$city)->where('type',$type)->where('status','1')->first();
            if($listing):
                Session::put('listingID', $listing->id);
            endif;
            return $listing;
        }
        public function locationCategry($type)
        {
            $listing = Listing::where('status', '1')->where('type',$type)->with(['price'])->paginate(9);
            return $listing;
        }
        public function locationListing($city)
        {
            $listing =  Listing::where('status', '1')->where('city', $city)->with(['price'])->paginate(9);
            return $listing;
        }
        public function singleBlog($slug)
        {
            $blog =  Blog::where('status', '1')->where('slug', $slug)->with(['comments' => function($query) {
                $query->where('status', '1'); 
            }])->first();
            return $blog;
        }
        public function singleArea($slug)
        {
            $location =  Location::where('status', '1')->where('slug', $slug)->first();
            return $location;
        }
        public function relatedBlog($id)
        {
            $relatedBlogs =  Blog::where('status', '1')->where('id','!=', $id)->inRandomOrder()->limit(3)->get();
            return $relatedBlogs;
        }
        public function getListingData()
        {
            $listingID = Session::get('listingID');
            $listing = Listing::with(['price'])->where('id',$listingID)->first();
            return $listing;
        }
        public function allListingData()
        {
            $listing = Listing::where('status', '1')->with(['price'])->paginate(9);
            return $listing;
        }
        public function allLocationData()
        {
            $location = Location::where('status', '1')->paginate(9);
            return $location;
        }
        public function getBookingPrice($request)
        {
            $result = bookingPrice($request);
            $price = Price::where('listing_id',$request['id'])->first();
            if($price) 
            {
                return response()->json([
                    'status' => 'sucess',
                    'price' => $result['price'],
                    'days' => $result['days'],
                    'servive_fee' => $result['servive_fee'],
                    'totalAmount' => $result['totalAmount'],
                ]);
            } 
            else 
            {
                return response()->json([
                    'error' => 'Product not found',
                ]);
            }
        }
        public function searchListing($request)
        {
            $listing = Listing::where('status', '1')
            ->when($request->has('type') && !empty($request->type), function ($query) use ($request) {
                $type = $request->type; 
                return $query->whereIn('type', $type); 
            })
            ->when($request->has('location') && !empty($request->location), function ($query) use ($request) {
                $location = explode(',', $request->location); 
                if (count($location) > 0) {
                    return $query->where('city', $location[0]); 
                }
            })
            ->when($request->has('rental_type') && !empty($request->rental_type), function ($query) use ($request) {
                $rental_type = $request->rental_type; 
                return $query->where('skipper', $rental_type); 
            })
            ->when($request->has('min_price') && !empty($request->min_price), function ($query) use ($request) {
                $min_price = $request->min_price;
                return $query->whereHas('price', function($query) use ($min_price) {
                    $query->where('price', '>=', $min_price);
                });
            })
            ->when($request->has('max_price') && !empty($request->max_price), function ($query) use ($request) {
                $max_price = $request->max_price;
                return $query->whereHas('price', function($query) use ($max_price) {
                    $query->where('price', '<=', $max_price);
                });
            })
            ->when($request->has('equipment') && !empty($request->equipment), function ($query) use ($request) {
                $equipment = $request->equipment;
                return $query->whereHas('equipment', function($query) use ($equipment) {
                    $query->whereRaw('JSON_CONTAINS(outdoor_equipment, ?)', [json_encode([$equipment])])
                        ->orWhereRaw('JSON_CONTAINS(extra_comfrot, ?)', [json_encode([$equipment])])
                        ->orWhereRaw('JSON_CONTAINS(navigation_equipment, ?)', [json_encode([$equipment])])
                        ->orWhereRaw('JSON_CONTAINS(kitchen, ?)', [json_encode([$equipment])])
                        ->orWhereRaw('JSON_CONTAINS(leisure_activities	, ?)', [json_encode([$equipment])])
                        ->orWhereRaw('JSON_CONTAINS(onboard_energy	, ?)', [json_encode([$equipment])])
                        ->orWhereRaw('JSON_CONTAINS(water_sports	, ?)', [json_encode([$equipment])]);
                });
            })
            ->when($request->has('halfday') && !empty($request->halfday), function ($query) use ($request) {
                return $query->whereHas('price', function ($query) {
                    $query->whereNotNull('one_half_day');
                });
            })
            ->when($request->has('fullday') && !empty($request->fullday), function ($query) use ($request) {
                return $query->whereHas('price', function ($query) {
                    $query->whereNotNull('one_half_day'); // Assuming this is the column name for full day
                });
            })
            ->when($request->has('overnightstay') && !empty($request->overnightstay), function ($query) use ($request) {
                return $query->whereHas('price', function ($query) {
                    $query->whereNotNull('over_night_price');
                });
            })
            ->with(['price','equipment'])
            ->paginate(9);
           
            return $listing;
        }
        public function submitRequest($request)
        {
            $data = [
                'email' => $request['email'],
                'label' => $request['label'],
                'subjact' => $request['subjact'],
                'message' => $request['message'],
            ];
            $file = '';
            if(isset($request['files'][0])):
                $file = $request['files'][0]; 
            endif;
            event(new RequestSubmitted($data, $file));
            return response()->json([
                'status' => 'success',
                'message' => 'Your request is submitted successfully.',
                'redirect_url' => route('thankyou'),
            ]);
        }
    }