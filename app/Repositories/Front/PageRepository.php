<?php
    namespace App\Repositories\Front;
    use App\Models\Admin\Listing;
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
            ->with(['price'])
            ->paginate(9);
            return $listing;
        }
    }