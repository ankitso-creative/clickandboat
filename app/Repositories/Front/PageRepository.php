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
            $listing = Listing::where('status','1')->with(['price'])->get();
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
    }