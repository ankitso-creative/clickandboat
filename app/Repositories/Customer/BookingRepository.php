<?php
    namespace App\Repositories\Customer;
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
        public function updateBooking($request,$id)
        {
            $order = Order::find($id);
            $order->cancel_reason = $request['cancel_reason'];
            $order->cancel_message = $request['cancel_message'];
            $order->payment_status = $request['payment_status'];
            if($order->update()):
                return true;
            else:
                return false;
            endif;
        }
    }

?>