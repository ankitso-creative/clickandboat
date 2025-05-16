<?php

use App\Models\Admin\Listing;
use App\Models\Admin\Setting;
use App\Models\Admin\Price;
use App\Models\Admin\SeasonPrice;
use Carbon\Carbon;

function clean($string, $symbol = "-")
{
    $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
    $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.

    return preg_replace('/-+/', $symbol, strtolower($string)); // Replaces multiple hyphens with single one.
}
function phoneWebsite()
{
    $setting = Setting::where('meta_key', 'phone')->first();
    $meta_value = $setting->meta_value;
    return $meta_value;
}
function emailWebsite()
{
    $setting = Setting::where('meta_key', 'email')->first();
    $meta_value = $setting->meta_value;
    return $meta_value;
}
function logoURL()
{
    $setting = Setting::first();
    $logo = $setting->getFirstMedia('logo');
    return $logo->getUrl() ?? '';
}
function whiteLogoURL()
{
    $setting = Setting::first();
    $logo = $setting->getFirstMedia('logo-white');
    return $logo->getUrl() ?? '';
}
function userName()
{
    $user = Auth::user();
    $userName = $user->name;
    return $userName;
}
function userImage()
{
    $user = Auth::user();
    $image = $user->getFirstMediaUrl('profile_image');
    if (!$image):
        $image = 'https://static1.clickandboat.com/v1/o/img/mask~dddc60cc1d.png';
    endif;
    return $image;
}
function bookingPrice($request,$currency='')
{
    $to = $currency;
    if(!$currency)
    {
        if(session()->has('currency_code')):
            $to = session('currency_code');
        else:
            $to = 'EUR';
        endif;
    }
    
    $fromCur = Listing::where('id',$request['id'])->value('currency');
    $startDate = Carbon::parse($request['checkindate']);
    $endDate = Carbon::parse($request['checkoutdate']);
    $days = $startDate->diffInDays($endDate)+1;
    $seasonData = SeasonPrice::where('listing_id', $request['id'])->get();
    $hasError  = true;
    if ($days >= 1) 
    {
        if (count($seasonData)) 
        {
            foreach ($seasonData as $key => $season) 
            {
                $from = json_decode($season->from);
                $month = $startDate->format('F');
                if(in_array($month,$from)) {
                    $hasError=false;
                    $seasonId = $season->id;
                    $price = Price::where('season_price_id', $seasonId)->first();
                    if ($price) 
                    {
                        $priceArray = $price->toArray();
                        if ($priceArray['one_half_day'] && $days == 1):
                            $total_price = getAmountWithoutSymble($season->price,$fromCur ,$to);
                        elseif ($priceArray['two_day'] && $days == 2):
                            $total_price = getAmountWithoutSymble($priceArray['two_day'],$fromCur ,$to);
                        elseif ($priceArray['three_day'] && $days == 3):
                            $total_price = getAmountWithoutSymble($priceArray['three_day'],$fromCur ,$to);
                        elseif ($priceArray['four_day'] && $days == 4):
                            $total_price = getAmountWithoutSymble($priceArray['four_day'],$fromCur ,$to);
                        elseif ($priceArray['five_day'] && $days == 5):
                            $total_price = getAmountWithoutSymble($priceArray['five_day'],$fromCur ,$to);
                        elseif ($priceArray['six_day'] && $days == 6):
                            $total_price = getAmountWithoutSymble($priceArray['six_day'],$fromCur ,$to);
                        elseif ($priceArray['one_week'] && $days <= 7):
                            $total_price = getAmountWithoutSymble($priceArray['one_week'],$fromCur ,$to);
                        else:
                            $total_price = getAmountWithoutSymble($season->price,$fromCur ,$to) * $days;
                        endif;
                        if($priceArray['one_half_day']):
                            $priceExist = 'yes';
                            $oneHalfDayPrice = getAmountWithoutSymble($priceArray['one_half_day'],$fromCur ,$to);
                        else:
                            $priceExist = 'no';
                            $oneHalfDayPrice = '';
                        endif;
                        $servive_fee = 0;
                        $totalAmount = $total_price + $servive_fee;
                       
                        $result = [
                            'price' => $total_price,
                            'priceExist' => $priceExist,
                            'oneHalfDayPrice' => $oneHalfDayPrice,
                            'days' => $days,
                            'servive_fee' => $servive_fee,
                            'totalAmount' => $totalAmount,
                        ];
                       
                    } 
                    else 
                    {
                        $total_price = getAmountWithoutSymble($season->price,$fromCur ,$to) * $days;
                        $servive_fee = 0;
                        $totalAmount = $total_price + $servive_fee;
                        $result = [
                            'price' => $total_price,
                            'days' => $days,
                            'servive_fee' => $servive_fee,
                            'totalAmount' => $totalAmount,
                        ];
                        
                    }
                }
            }
        } 
        else 
        {
            $price = Price::where('listing_id', $request['id'])->first();
            if ($price) {
                $priceArray = $price->toArray();
                $total_price = getAmountWithoutSymble($priceArray['price'],$fromCur ,$to) * $days;
                $servive_fee = 0;
                $totalAmount = $total_price + $servive_fee;
                $result = [
                    'price' => $total_price,
                    'days' => $days,
                    'servive_fee' => $servive_fee,
                    'totalAmount' => $totalAmount,
                ];
               
            } 
            else 
            {
                $total_price = 0;
                $result['error'] = 'Product not found';
            }
        }
        if($hasError)
        {
            $result['status'] = 'error';
            $result['message'] = 'Please select different date.';
        }
        return $result;
    }
}
function selectOption($table, $columnName, $columnValue, $selectedValue = '', $condition = '', $orderBy = '')
{
    $html = "";

    $items = DB::table($table)->select($columnValue, $columnName)
        ->when(is_array($condition), function ($query) use ($condition) {
            $query->where($condition[0], $condition[1]);
        })
        ->when(is_array($orderBy), function ($query) use ($condition) {
            $query->orderBy($orderBy[0], $orderBy[1]);
        })->get()->toArray();

    if ($items):
        foreach ($items as $item):
            $item = (array) $item;
            $selected = '';
            if ($item[$columnValue] == $selectedValue):
                $selected = 'selected';
            endif;
            $html .= '<option value = "' . $item[$columnValue] . '" ' . $selected . '>' . $item[$columnName] . '</option>';
        endforeach;
    endif;

    return $html;
}
function checkCheckbox($array, $value)
{
    if (!empty($array)):
        if (in_array($value, $array)):
            return 'checked';
        else:
            return false;
        endif;
    else:
        return false;
    endif;
}
function singleCheckbox($selected, $value)
{
    if (!empty($selected)):
        if ($value == $selected):
            return 'checked';
        else:
            return false;
        endif;
    else:
        return false;
    endif;
}
function checkradio($selected, $value)
{
    if (!empty($selected)):
        if ($value == $selected):
            return 'checked';
        else:
            return false;
        endif;
    else:
        return false;
    endif;
}
function checkselect($selected, $value)
{
    if (!empty($selected)):
        if ($value == $selected):
            return 'selected';
        else:
            return false;
        endif;
    else:
        return false;
    endif;
}
function checkSelectMulti($array, $value)
{
    if (!empty($array)):
        if (in_array($value, $array)):
            return 'selected';
        else:
            return false;
        endif;
    else:
        return false;
    endif;
}
function maxPriceValue()
{
    $maxPrice = DB::table('prices')->max('price');
    return $maxPrice;
}
function maxLengthValue()
{
    $maxPrice = DB::table('listings')->max('length');
    return $maxPrice;
}
function minMaxPrice($season, $price = '')
{
    if(session()->has('currency_code')):
        $to = session('currency_code');
    else:
        $to = 'EUR';
    endif;
    $from = Listing::where('id',$season->listing_id)->value('currency');
    unset($season->id);
    unset($season->listing_id);
    unset($season->season_price_id);
    unset($season->price);
    unset($season->created_at);
    unset($season->updated_at);
    $season = $season ? $season->toArray() : [];
    if ($price) {
        $price = array($price);
    }
    if (is_array($season) && is_array($price)) {
        $season = array_merge($season, $price);
    }
    $min = min($season);
    $max = max($season);
    if ($min && $max) {
        return getAmountWithSymble($min,$from,$to) . ' - ' . getAmountWithSymble($max,$from,$to);
    } else {
        if ($min) {
            return getAmountWithSymble($min,$from,$to);
        } else {
            return getAmountWithSymble($max,$from,$to);
        }
    }
}
function priceWithHtml($season, $price = '')
{
    if(session()->has('currency_code')):
        $to = session('currency_code');
    else:
        $to = 'EUR';
    endif;
    $from = Listing::where('id',$season->listing_id)->value('currency');
    unset($season->id);
    unset($season->listing_id);
    unset($season->season_price_id);
    unset($season->price);
    unset($season->created_at);
    unset($season->updated_at);
    $season = $season ? $season->toArray() : [];
    if ($price) {
        $price = array('full_day_price' => $price);
    }
    if (is_array($season) && is_array($price)) {
        $season = array_merge($price,$season, );
    }
    $priceHtml = '';
    if($season):
        foreach($season as $key => $value):
            if($value):
                $priceHtml .= '<p>'.ucfirst(str_replace('_',' ',$key)).': <span>'. getAmountWithSymble($value,$from,$to).'</span></p>';
            endif;
        endforeach;
    endif;
    return $priceHtml;
}
function priceSymbol($code)
{
    $symbols = [
        "EUR" => '€',
        "USD" => '$',
        "GBP" => '£',
        "CHF" => 'CHF',
        "RUB" => '₽',
        "NOK" => 'kr',
        "SEK" => 'kr',
        "DKK" => 'kr',
        "CZK" => 'kr',
        "PLN" => 'zł',
        "CAD" => 'CAD',
        "AUD" => 'AUD',
        "HUF" => 'ft',
        "RON" => 'lei',
        "BGN" => 'Лв',
        "HRK" => 'kn',
        "BRL" => 'BRL',
        "ARS" => '$',
        "ILS" => '₪',
        "AED" => 'د.إ ',
        "CLP" => '$',
        "COP" => '$',
        "MXN" => '$',
        "UYU" => '$',
    ];
    return $symbols[$code] ?? $code;
}
function getAmountWithoutSymble($price, $from, $to)
{
    if($from == $to):
        return $price;
    else:
        $req_url = 'https://api.exchangerate-api.com/v4/latest/'.$from;
        $response_json = file_get_contents($req_url);
        if(false !== $response_json) {
            try {
                $response_object = json_decode($response_json);
                $price = round(($price * $response_object->rates->{$to}), 2);
                return $price;
            }
            catch(Exception $e) {
                // Handle JSON parse error...
            }
        }
    endif;
}
function getAmountWithSymble($price, $from, $to)
{
    if($from == $to):
        return priceSymbol($from).$price;
    else:
        $req_url = 'https://api.exchangerate-api.com/v4/latest/'.$from;
        $response_json = file_get_contents($req_url);
        if(false !== $response_json) {
            try {
                $response_object = json_decode($response_json);
                $price = round(($price * $response_object->rates->{$to}), 2);
                return priceSymbol($to).$price;
            }
            catch(Exception $e) {
                // Handle JSON parse error...
            }
        }
    endif;
}
function getListingPrice($slug)
{
    $listing = Listing::where('slug',$slug)->with('seasonPrice')->first();
    $seasonPrice = $listing->seasonPrice;
    if(count($listing->seasonPrice)):
        $price = $seasonPrice[0]['price'];
        if(session()->has('currency_code')):
            $to = session('currency_code');
        else:
            $to = 'EUR';
        endif;
        $price = getAmountWithSymble($price,$listing->currency, $to);
        return $price;
    else:
        return '';
    endif;  
}
function Timeago($time)
{
    $time = strtotime($time);
	$time_difference = time() - $time;
    if( $time_difference < 1 ) { return 'less than 1 second ago'; }
	$condition = array( 12 * 30 * 24 * 60 * 60 =>  'year',
				30 * 24 * 60 * 60       =>  'month',
				24 * 60 * 60            =>  'day',
				60 * 60                 =>  'hour',
				60                      =>  'min',
				1                       =>  'sec'
	);
    foreach( $condition as $secs => $str )
	{
		$d = $time_difference / $secs;

		if( $d >= 1 )
		{
			$t = round( $d );
			return  $t . ' ' . $str . ( $t > 1 ? 's' : '' ) . ' ago';
		}
	}
}
