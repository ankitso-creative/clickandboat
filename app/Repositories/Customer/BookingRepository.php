<?php
    namespace App\Repositories\Customer;

use App\Models\Admin\Listing;
use App\Models\ListingReview;
    use App\Models\Order;


    class BookingRepository
    {
        public function bookingAll()
        {
            $userId = auth()->id();
            $results = Order::where('user_id',$userId)->get();
            return $results;
        }
        public function editBooking($id)
        {
            $userId = auth()->id();
            return Order::where('user_id',$userId)->where('id',$id)->first();
        }
        // public function updateBooking($request,$id)
        // {
        //     $order = Order::find($id);
        //     $order->cancel_reason = $request['cancel_reason'];
        //     $order->cancel_message = $request['cancel_message'];
        //     $order->payment_status = $request['payment_status'];
        //     if($order->update()):
        //         return true;
        //     else:
        //         return false;
        //     endif;
        // }
        public function updateBooking($request,$id)
        {
            $order = Order::find($id);
            $order->cancel_reason = $request['cancel_reason'];
            $order->cancel_message = $request['cancel_message'];
            $order->payment_status = $request['payment_status'];
            //$exist = ListingReview::where('user_id',$order->user_id)->where('listing_id',$order->listing_id)->exists();
            if(isset($request['evidence']) && !empty($request['evidence'])):
                if ($order->hasMedia('evidence')) {
                    $order->getMedia('evidence')->each(function ($media) {
                        $media->delete(); 
                    });
                }
                $media = $order->addMediaFromRequest('evidence')->toMediaCollection('evidence','evidence_files'); 
            endif;
            if($order->update()):
                // if($order->payment_status == 'cancel'):
                //     event(new CancelBooking($order));
                // endif;
            
                return true;
            else:
                return false;
            endif;
        }
        public function storeReview($request)
        {
            $review = new ListingReview();

            $listingId = Listing::where('slug',$request['slug'])->value('id');
            $userId = auth()->id();
            $review->listing_id =  $listingId;
            $review->user_id =  $userId;
            $review->rate = $request['rating'];
            $review->review = $request['review'];
            if($review->save()):
                return true;
            else:
                return false;
            endif;
        }
    }

?>