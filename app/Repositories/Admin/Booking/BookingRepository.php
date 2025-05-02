<?php
namespace App\Repositories\Admin\Booking;
use App\Models\Admin\Blog;
use App\Models\Admin\BlogComment;
use App\Models\Order;

class BookingRepository
{
    public function allBlogs($request)
    {
        $blog = Blog::when($request->has('name') && !empty($request->name), function ($query) use ($request) {
            $name = $request->name; 
            return $query->where('title', $name); 
        })
        ->when($request->has('language') && !empty($request->language), function ($query) use ($request) {
            $language = $request->language; 
            return $query->where('language', $language); 
        })
        ->orderBy('order_by', 'ASC')
        ->paginate(9);

        return $blog;
    }
    public function allBookings()
    {
        $bookings = Order::all();
        return $bookings;
    }
    
}