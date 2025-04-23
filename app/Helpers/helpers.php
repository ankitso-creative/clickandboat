<?php

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
function bookingPrice($request)
{
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
                            $total_price = $priceArray['one_half_day'];
                        elseif ($priceArray['two_day'] && $days == 2):
                            $total_price = $priceArray['two_day'];
                        elseif ($priceArray['three_day'] && $days == 3):
                            $total_price = $priceArray['three_day'];
                        elseif ($priceArray['four_day'] && $days == 4):
                            $total_price = $priceArray['four_day'];
                        elseif ($priceArray['five_day'] && $days == 5):
                            $total_price = $priceArray['five_day'];
                        elseif ($priceArray['six_day'] && $days == 6):
                            $total_price = $priceArray['six_day'];
                        elseif ($priceArray['one_week'] && $days <= 7):
                            $total_price = $priceArray['one_week'];
                        else:
                            $total_price = $season->price * $days;
                        endif;
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
                        $total_price = $season->price * $days;
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
                $total_price = $priceArray['price'] * $days;
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
        return $min . ' - ' . $max;
    } else {
        if ($min) {
            return $min;
        } else {
            return $max;
        }
    }
}
function getAmountWithSymble($price, $code)
{
    $req_url = 'https://api.exchangerate-api.com/v4/latest/USD';
    $response_json = file_get_contents($req_url);
    if(false !== $response_json) {
        try {
            $response_object = json_decode($response_json);
            $EUR_price = round(($price * $response_object->rates->EUR), 2);
        }
        catch(Exception $e) {
            // Handle JSON parse error...
        }
    }
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
