<?php 
namespace App\Repositories\BoatOwner;

use App\Events\Front\CancelBooking;
use App\Models\Admin\Booking;
use App\Models\Order;
use App\Models\User;

class BookingRepository
{
    public function allBooking()
    {
        $user = auth()->user();
        $bookings = Order::whereHas('listing', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })
        ->with(['user', 'listing'])
        ->orderBy('created_at', 'desc') // optional: sort by latest
        ->paginate(10); // change 10 to whatever per-page count you want
        return $bookings;
    }
    public function editBooking($id)
    {
        return Order::find($id);
    }
    public function updateBooking($request,$id)
    {
        $order = Order::find($id);
        $order->cancel_reason = $request['cancel_reason'];
        $order->cancel_message = $request['cancel_message'];
        $order->payment_status = $request['payment_status'];
        if(isset($request['evidence']) && !empty($request['evidence'])):
            if ($order->hasMedia('evidence')) {
                $order->getMedia('evidence')->each(function ($media) {
                    $media->delete(); 
                });
            }
            $media = $order->addMediaFromRequest('evidence')->toMediaCollection('evidence','evidence_files'); 
        endif;
        if($order->update()):
            if($order->payment_status == 'cancel'):
                event(new CancelBooking($order));
            endif;
            return true;
        else:
            return false;
        endif;
    }
    
}