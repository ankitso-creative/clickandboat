<?php

namespace App\Http\Controllers\Site;

use App\Events\Front\BookingCustomer;
use App\Events\Front\BookingOwner;
use App\Http\Controllers\Controller;
use App\Models\Admin\Listing;
use App\Models\Admin\Quotation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Auth;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use App\Models\Order;
use Illuminate\Support\Facades\Crypt;

class StripeController extends Controller
{
    public function createPaymentIntent(Request $request)
    {
        $request = $request->all();
        $quotationID = Crypt::decrypt($request['quotationID']);
        $quotation = Quotation::find($quotationID);
        $listing = Listing::find($quotation->listing_id);
        if($request['paymentType'] == 'deposit-payment' && $listing->security && optional($listing->security)->security_deposit == '1'):
			if($listing->security->type == 1):
                $depositAmount = $listing->security->amount;
            else:
                $amount = $listing->security->amount;
                $depositAmount = $quotation['total'] * $amount / 100;
            endif;
        else:
            $totalAmount = $quotation['total'];
            $fuel_price = 0;
            $skipper_price = 0;
            if($listing->fuel_include == '1'):
                $fuel_price = getAmountWithoutSymble($listing->fuel_price,$listing->currency,$quotation->currency);
            endif;
            if($listing->skipper_include == '1'):
                $skipper_price = getAmountWithoutSymble($listing->skipper_price,$listing->currency,$quotation->currency);
            endif;
            $depositAmount = $totalAmount +$fuel_price + $skipper_price;
        endif;
        Stripe::setApiKey(config('services.stripe.secret'));
        try {
            $paymentIntent = PaymentIntent::create([
                'amount' => $depositAmount * 100, 
                'currency' => $quotation->currency,
                'payment_method_types' => ['card'],
                'confirmation_method' => 'automatic',  
                'capture_method' => 'automatic', 
            ]);
             return response()->json([
                'clientSecret' => $paymentIntent->client_secret,
            ]);

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function confirmPaymentIntent(Request $request)
    {
        $paymentIntentId = $request->input('paymentIntentId');
        $paymentStatus = $request->input('paymentStatus');
        $quotationID = $request->input('quotationID');
        $paymentType = $request->input('paymentType');
        $quotationID = Crypt::decrypt($quotationID);
        $quotation = Quotation::find($quotationID);
        $listing = Listing::find($quotation->listing_id);
        if( $paymentType == 'deposit-payment' && $listing->security && optional($listing->security)->security_deposit == '1'):
			if($listing->security->type == 1):
                $depositAmount = $listing->security->amount;
                $fuel_price = 0;
                $skipper_price = 0;
                if($listing->fuel_include == '1'):
                    $fuel_price = getAmountWithoutSymble($listing->fuel_price,$listing->currency,$quotation->currency);
                endif;
                if($listing->skipper_include == '1'):
                    $skipper_price = getAmountWithoutSymble($listing->skipper_price,$listing->currency,$quotation->currency);
                endif;
                $totalAmount = $quotation['total']+ $fuel_price + $skipper_price;
                $pending_amount = $totalAmount - $depositAmount;
            else:
                $amount = $listing->security->amount;
                $depositAmount = $quotation['total'] * $amount / 100;
                $fuel_price = 0;
                $skipper_price = 0;
                if($listing->fuel_include == '1'):
                    $fuel_price = getAmountWithoutSymble($listing->fuel_price,$listing->currency,$quotation->currency);
                endif;
                if($listing->skipper_include == '1'):
                    $skipper_price = getAmountWithoutSymble($listing->skipper_price,$listing->currency,$quotation->currency);
                endif;
                $totalAmount = $quotation['total'] + $fuel_price + $skipper_price;
                $pending_amount = $totalAmount - $depositAmount;
            endif;
        else:
            $totalAmount = $quotation['total'];
            $fuel_price = 0;
            $skipper_price = 0;
            if($listing->fuel_include == '1'):
                $fuel_price = getAmountWithoutSymble($listing->fuel_price,$listing->currency,$quotation->currency);
            endif;
            if($listing->skipper_include == '1'):
                $skipper_price = getAmountWithoutSymble($listing->skipper_price,$listing->currency,$quotation->currency);
            endif;
            $depositAmount = $totalAmount + $fuel_price + $skipper_price;
            $pending_amount = 0;
        endif;
        
        $from = $quotation->checkin;
        $to = $quotation->checkout;
        if ($paymentStatus !== 'succeeded') {
            return response()->json(['error' => 'Payment was not successful.'], 400);
        }
        try 
        {
            Stripe::setApiKey(config('services.stripe.secret'));
            $paymentIntent = PaymentIntent::retrieve($paymentIntentId);
            if ($paymentIntent->status === 'succeeded') 
            {
                $user = Auth::user(); 
                $order = Order::create([
                    'payment_intent_id' => $paymentIntent->id,
                    'payment_status' => $paymentIntent->status,
                    'user_id' => $user->id,
                    'check_in' => $from,
                    'check_out' => $to,
                    'pending_amount' => $pending_amount,
                    'amount_paid' => $depositAmount,
                    'listing_id' => $listing->id,
                    'sub_total' => $depositAmount + $pending_amount,
                    'total' => $totalAmount,
                    'currency' => $quotation->currency,
                ]);
                event(new BookingCustomer($order));
                event(new BookingOwner($order));
                return response()->json([
                    'message' => 'Payment confirmed and order saved successfully.',
                    'order_id' => $order->id,
                    'url' => route('customer.paymentconfirm'),
                ]);
            } 
            else 
            {
                return response()->json(['error' => 'Payment was not successful.'], 400);
            }
        } 
        catch (\Exception $e) 
        {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}

