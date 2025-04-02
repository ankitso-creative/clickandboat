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
    }

?>