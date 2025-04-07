<?php

namespace App\Http\Controllers\Site;

use App\Enums\Auth\Role\RolesEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\Checkout\CheckoutRequest;
use Illuminate\Http\Request;
use App\Services\Front\PageService;
use Illuminate\Support\Facades\Session;
use Auth;
class PagesController extends Controller
{
    protected $service;
    public function __construct()
    {
        $this->service = new PageService();
    }
    public function index()
    {
        $blogs = $this->service->blogs();
        $categories = $this->service->categories();
        $locations = $this->service->locations();
        return view('front.index',compact('blogs','categories','locations'));
    }
    public function thankYou()
    {
        return view('front.thankyou');
    }
    public function single($slug)//test_boat
    {
        $listing = $this->service->singleBoat($slug);
        if(!$listing)
        {
            return redirect()->route('home');
        }
        return view('front.single_boat',compact('listing'));
    }
    public function singleBoat($city,$type,$slug)//test_boat
    {
        $listing = $this->service->singleBoatDetails($city,$type,$slug);
        $calendarArray = '';
        if(count($listing->calendar))
        {
            $calendarArray = [];
            $calendars = $listing->calendar;
            foreach($calendars as $key => $calendar):
                $calendarArray[$key] = [
                    'from' => $calendar['from_date'],
                    'to' => $calendar['from_to'],
                ];
            endforeach;
           //dd($calendarArray);
            $calendarArray = json_encode($calendarArray, JSON_FORCE_OBJECT);
           // dd($calendarArray);
        }
       
        if(!$listing)
        {
            return redirect()->route('home');
        }
        return view('front.single_boat',compact('listing','calendarArray'));
    }
    public function locationCategry($type)//test_boat
    {
        $results = $this->service->locationCategry($type);
        return view('front.search',compact('results'));
    }
    public function locationListing($city)//test_boat
    {
        $results = $this->service->locationListing($city);
        return view('front.location',compact('results'));
    }
    public function getBookingPrice(Request $request)
    {
        $request = $request->all();
        return $this->service->getBookingPrice($request);
    }
    public function checkout(CheckoutRequest $request)
    {
        $request =  $request->all();
        $listing = $this->service->getListingData();
        if (Session::has('dateData') && Auth::check()):
            $user = Auth::user();
            if($user->role != RolesEnum::CUSTOMER->value)
            {
                return redirect()->route('home');
            }
            if(isset($request['checkin_date']) && isset($request['checkout_date']) && isset($request['days_val'])):
                $sessionArray = [
                    'checkin_date' => $request['checkin_date'],
                    'checkout_date' => $request['checkout_date'],
                    'days_val' => $request['days_val'],
                ];
                Session::put('dateData', $sessionArray);
            endif;
        else:
            $sessionArray = [
                'checkin_date' => $request['checkin_date'],
                'checkout_date' => $request['checkout_date'],
                'days_val' => $request['days_val'],
            ];
            Session::put('dateData', $sessionArray);
            return redirect()->route('login');
        endif;
        $dateData = Session::get('dateData');
        $request['id'] = Session::get('listingID');
        $listingID = $request['id'];
        $request['checkindate'] = $request['checkin_date'];
        $request['checkoutdate'] = $request['checkout_date'];
        $price = bookingPrice($request);
        return view('front.checkout',compact('dateData','listing','price','listingID'));
    }
    public function aboutUs()
    {
        return view('front.about');
    }
    public function contact()
    {
        return view('front.contact');
    }
    public function boats()
    {
        $results =  $this->service->allListingData();
        return view('front.location',compact('results'));
    }
    public function location()
    {
        $results =  $this->service->allLocationData();
        return view('front.location_city',compact('results'));
    }
    public function singleLocation()
    {
        return view('front.single_location');
    }
    public function ourStory()
    {
        return view('front.ourstory');
    }
    public function team()
    {
        return view('front.team');
    }
    public function mission()
    {
        return view('front.mission');
    }
    public function PrivacyPolicy()
    {
        return view('front.privacy-policy');
    }
    public function terms()
    {
        return view('front.terms');
    }
    public function blog()
    {
        $blogs = $this->service->allBlogs();
        return view('front.blog',compact('blogs'));
    }
    public function singleBlog($slug)
    {
        $result = $this->service->singleBlog($slug);
        $relatedBlogs = $this->service->relatedBlog($result->id);
        
        return view('front.single_blog',compact('result','relatedBlogs'));
    }
    public function area($slug)
    {
        $result = $this->service->singleArea($slug);
        return view('front.single_location',compact('result'));
    }
   
    public function help()
    {
        return view('front.help');
    }
    public function requestSubmit()
    {
        return view('front.request-submit');
    }
    public function search(Request $request)
    {
        //$request = $request->all();
        $results = $this->service->searchListing($request);
        return view('front.search',compact('results'));
    }
    public function submitRequest(Request $request)
    {
        $request = $request->all();
        return $this->service->submitRequest($request);
         
    }
    
}