<?php

namespace App\Http\Controllers\Site;

use App\Enums\Auth\Role\RolesEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\Checkout\CheckoutRequest;
use App\Http\Requests\Site\Contact\ContactFormRequest;
use App\Models\Admin\Faq;
use Illuminate\Http\Request;
use App\Services\Front\PageService;
use Illuminate\Support\Facades\Session;
use Auth;
use Illuminate\Support\Facades\Crypt;

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
        $featureds = $this->service->featureds();
        return view('front.index',compact('blogs','categories','locations','featureds'));
    }
    public function thankYou()
    {
        return view('front.thankyou');
    }
    public function single($slug)//test_boat
    {
        $userAgent = request()->header('User-Agent');
        $listing = $this->service->singleBoat($slug);
        $isMobile = preg_match('/Mobile|Android|iPhone|iPad|iPod/i', $userAgent);
        if(!$listing)
        {
            return redirect()->route('home');
        }
        return view('front.single_boat',compact('listing','isMobile'));
    }
    public function singleBoat($city,$type,$slug)//test_boat
    {
        $userAgent = request()->header('User-Agent');
        $isMobile = preg_match('/Mobile|Android|iPhone|iPad|iPod/i', $userAgent);
        if(session()->has('currency_code')):
            $symble = priceSymbol(session('currency_code'));
        else:
            $symble = priceSymbol('EUR');
        endif;
        $listing = $this->service->singleBoatDetails($city,$type,$slug);
        $calendarArray = '';
        if(!$listing)
        {
            return redirect()->route('home');
        }
        $equipments = $listing->equipment;
        $flatItems=[];
        $sixEquipments='';
        $viewEquipments='';
        $totalEquipments = 0;
        if($equipments):
            unset($equipments->id);
            unset($equipments->listing_id);
            unset($equipments->created_at);
            unset($equipments->updated_at);
            $equipments = $equipments->toArray();
            foreach ($equipments as $category => $itemsJson) 
            {
                $items = json_decode($itemsJson, true);
                if($items):
                    $flatItems = array_merge($flatItems, $items);
                endif;
            }
            $sixEquipments = array_slice($flatItems,0,6);
            $totalEquipments = count($flatItems);
            $viewEquipments = count($flatItems) - 6;
        endif;
        return view('front.single_boat',compact('listing','calendarArray','equipments','viewEquipments','sixEquipments','totalEquipments','symble','isMobile'));
    }
    public function locationCategry(Request $request , $type)//test_boat
    {
        $userAgent = $request->header('User-Agent');
        $isMobile = preg_match('/Mobile|Android|iPhone|iPad|iPod/i', $userAgent);
        $results = $this->service->locationCategry($type);
        return view('front.search',compact('results','isMobile'));
    }
    public function locationListing(Request $request,$city)//test_boat
    {
        $userAgent = $request->header('User-Agent');
        $isMobile = preg_match('/Mobile|Android|iPhone|iPad|iPod/i', $userAgent);
        $results = $this->service->locationListing($city);
        return view('front.search',compact('results','isMobile'));
    }
    public function getBookingPrice(Request $request)
    {
        $request = $request->all();
        return $this->service->getBookingPrice($request);
    }
    public function checkout(CheckoutRequest $request)
    {
        $request =  $request->all();
        $listing = $this->service->getListingData($request);
        if(!$listing):
            return redirect()->route('customer.dashboard.index'); 
        endif;
        $quotation = $this->service->getQuotationData($request);
        $quotationID = Crypt::encrypt($quotation->id);
        return view('front.checkout',compact('listing','quotation','quotationID'));
    }
    public function aboutUs()
    {
        return view('front.about');
    }
    public function contact()
    {
        return view('front.contact');
    }
    public function submitEnquiry(ContactFormRequest $request)
    {
        $request = $request->all();
        return $this->service->submitEnquiry($request);
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
   
    public function help(Request $request)
    {
        //$request = $request->all();
        $faqs = Faq::where('status', '1')
        ->when($request->has('question') && !empty($request->question), function ($query) use ($request) {
            $question = $request->question;
            return $query->where('question', 'like', '%' . $question . '%');
        })
        ->paginate(5);
        if ($request->ajax()) 
        {
            $html = '';
            $fCount = ($faqs->currentPage() - 1) * $faqs->perPage();
            if(count($faqs)):
                foreach($faqs as $faq):
                    $fCount++;
                    $html .= '<div class="card">
                            <div id="heading'.$faq->id.'" class="border-0 shadow-sm card-header">
                                <h2 class="mb-0">
                                    <button type="button" data-toggle="collapse" data-target="#collapse'.$faq->id.'"
                                        aria-expanded="false" aria-controls="collapse'.$faq->id.'"
                                        class="btn btn-link collapsed text-dark font-weight-bold text-uppercase collapsible-link">
                                        '.$fCount.'. '.$faq->question.'
                                    </button>
                                </h2>
                            </div>
                            <div id="collapse'.$faq->id.'" aria-labelledby="heading'.$faq->id.'" data-parent="#accordionExample"
                                class="collapse">
                                <div class="card-body">
                                    <p class="m-0">'.$faq->answer.'</p>
                                </div>
                            </div>
                        </div>';
                endforeach;
            endif;
            return response()->json([
                'html' => $html,
                'next_page' => $faqs->currentPage() < $faqs->lastPage() ? $faqs->currentPage() + 1 : null
            ]);
        }
        return view('front.help',compact('faqs'));
    }
    public function requestSubmit()
    {
        return view('front.request-submit');
    }
    public function search(Request $request)
    {
        //$request = $request->all();
        $userAgent = $request->header('User-Agent');
        $isMobile = preg_match('/Mobile|Android|iPhone|iPad|iPod/i', $userAgent);
        $results = $this->service->searchListing($request);
        return view('front.search',compact('results','isMobile'));
    }
    public function submitRequest(Request $request)
    {
        $request = $request->all();
        return $this->service->submitRequest($request);
         
    }
    
}