<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Auth;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use App\Models\Order;

class StripeController extends Controller
{
    public function createPaymentIntent(Request $request)
    {
        $request = $request->all();
        $request['id'] = Session::get('listingID');
        $request['checkindate'] = $request['from'];
        $request['checkoutdate'] = $request['to'];
        $price = bookingPrice($request);
        Stripe::setApiKey(config('services.stripe.secret'));
        try {
            $paymentIntent = PaymentIntent::create([
                'amount' => $price['price'] * 100, 
                'currency' => 'usd',
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
        $from = $request->input('from');
        $to = $request->input('to');
        $listingID = $request->input('listingID');
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
                    'listing_id' => $listingID,
                    'sub_total' => $paymentIntent->amount_received / 100,
                    'total' => $paymentIntent->amount_received / 100,
                    'amount_paid' => $paymentIntent->amount_received / 100,
                ]);
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

