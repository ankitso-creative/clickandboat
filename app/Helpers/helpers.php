<?php
    use App\Models\Admin\Setting;
    use App\Models\Admin\Price;
    use Carbon\Carbon;
    function clean($string,$symbol="-") 
    {
        $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
        $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
        
        return preg_replace('/-+/', $symbol, strtolower($string)); // Replaces multiple hyphens with single one.
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
        if(!$image):
            $image = 'https://static1.clickandboat.com/v1/o/img/mask~dddc60cc1d.png';
        endif;
        return $image;
    }
    function bookingPrice($request)
    {
        $price = Price::where('listing_id',$request['id'])->first();
        $startDate = Carbon::parse($request['checkindate']);
        $endDate = Carbon::parse($request['checkoutdate']);
        $days = $startDate->diffInDays($endDate);
        if($price) 
        {
            $priceArray = $price->toArray();
            if($priceArray['one_half_day'] && $days == 1):
                $total_price = $priceArray['one_half_day'] * $days;
            elseif($priceArray['two_day'] && $days == 2):
                $total_price = $priceArray['two_day'] * $days;
            elseif($priceArray['three_day'] && $days == 3):
                $total_price = $priceArray['three_day']  * $days;
            elseif($priceArray['four_day'] && $days == 41):
                $total_price = $priceArray['four_day']  * $days;
            elseif($priceArray['five_day'] && $days == 5):
                $total_price = $priceArray['five_day'] * $days;
            elseif($priceArray['six_day'] && $days == 6):
                $total_price = $priceArray['six_day'] * $days;
            elseif($priceArray['one_week'] && $days <= 7):
                $total_price = $priceArray['one_week'] * $days;
            else:
                $total_price = $priceArray['price'] * $days;
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
            $result['error'] = 'Product not found';
        }
        return $result;
    }
    function selectOption($table, $columnName, $columnValue, $selectedValue='', $condition = '', $orderBy = '')
    {
        $html ="";

        $items = DB::table($table)->select($columnValue, $columnName)
        ->when(is_array($condition), function($query) use($condition){
            $query->where($condition[0],$condition[1]);
        })
        ->when(is_array($orderBy), function($query) use($condition){
            $query->orderBy($orderBy[0],$orderBy[1]);
        })->get()->toArray();

        if($items):
            foreach($items as $item):
                $item = (array) $item;
                $selected = '';
                if($item[$columnValue]==$selectedValue):
                    $selected = 'selected';
                endif;
                $html .= '<option value = "'.$item[$columnValue].'" '. $selected.'>'.$item[$columnName].'</option>';
            endforeach;
        endif;
        
        return $html;
    }
    function checkCheckbox($array,$value)
    {
        if(!empty($array)):
            if(in_array($value,$array)):
                return 'checked';
            else:
                return false;
            endif;
        else:
            return false;
        endif;
    }
    function checkradio($selected,$value)
    {
        if(!empty($selected)):
            if($value==$selected):
                return 'checked';
            else:
                return false;
            endif;
        else:
            return false;
        endif;
    }
    function checkselect($selected,$value)
    {
        if(!empty($selected)):
            if($value==$selected):
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
?>