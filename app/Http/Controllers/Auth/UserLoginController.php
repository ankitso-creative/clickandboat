<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Auth; 
class UserLoginController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            return redirect()->route('customer.dashboard');  
        }
        return view('front.login'); 
    }
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) 
        {
            Session::forget('email-user'); 
            $user = Auth::user();
            if ($user->status != 1) 
            {
                Auth::logout(); 
                return redirect()->route('login')->with('error','You are not authorized to access this account.');
            }
            if(Session::has('listingslug') && $user->role == 'customer'):
                $slug = Session::get('listingslug');
                $type = Session::get('listingtype');
                $city = Session::get('listingcity');
                return redirect()->route('singleboat', ['city' => $city, 'type' => $type, 'slug' => $slug]);
            else:
                return redirect()->route('customer.dashboard');
            endif;
        }
        return redirect()->back()->withErrors(['email' => 'These credentials do not match our records.']);
    }
    public function logout()
    {
        Auth::logout(); 
        return redirect()->route('login');  
    }
}
