<?php

namespace App\Http\Controllers\Auth;

use App\Enums\Auth\Role\RolesEnum;
use App\Events\Auth\NewUserRegistered;
use App\Events\Auth\UserRegistered;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Session;

class UserRegisterController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            return redirect()->route('customer.dashboard');  // Redirect to dashboard if user is already logged in
        }
        return view('front.register');
    }
    public function checkBoat()
    {
        if (Auth::check()) {
            return redirect()->route('customer.dashboard');  // Redirect to dashboard if user is already logged in
        }
        $role = 'boatowner';
        return view('front.checkusers',compact('role'));
    }
    public function checkUser()
    {
        if (Auth::check()) {
            return redirect()->route('customer.dashboard');  // Redirect to dashboard if user is already logged in
        }
        $role = 'customer';
        return view('front.checkusers',compact('role'));
    }
    public function checkUserEmailLogin(Request $request)
    {
        $messages = [
            'email.required' => 'Email address is required.',
            'email.email' => 'Please provide a valid email address.',
        ];
        // Validate the incoming request data
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255',
            'role' => '',
        ],$messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        Session::put('email-user', $request->email);
        $emailExists = User::where('email', $request->email)->exists();
        if($emailExists):
            return redirect()->route('login');
        else:
            if($request->role == 'boatowner'):
                return redirect()->route('register-your-boat'); 
            else:
                return redirect()->route('register'); 
            endif;
        endif;
        
    }
    public function registerYourBoat()
    {
        if (Auth::check()) {
            return redirect()->route('customer.dashboard');
        }
        return view('front.register_your_boat');
    }
    public function register(Request $request)
    {
        if (Auth::check()) {
            return redirect()->route('customer.dashboard');
        }
        $messages = [
            'fname.required' => 'Please enter your first name.',
            'fname.string' => 'Your first name must be a string.',
            'lname.required' => 'Please enter your last name.',
            'lname.string' => 'Your last name must be a string.',
            'email.required' => 'Email address is required.',
            'email.email' => 'Please provide a valid email address.',
            'email.unique' => 'This email is already registered.',
            'password.required' => 'A password is required.',
        ];
        // Validate the incoming request data
        $validator = Validator::make($request->all(), [
            'fname' => 'required|string',
            'lname' => 'required|string',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required',Password::min(8)->mixedCase()->letters()->numbers()->symbols(),],
            'role' => '',
        ],$messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $status = 1;
        if(isset($request->role)):
            $status = 1;
        endif;
        $user = User::create([
            'name' => $request->fname.' '.$request->lname,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'role' => $request->role ?? 'customer',
            'status' => $status,
        ]);
        if($user->role == RolesEnum::BOATOWNER->value)
        {
            //event(new UserRegistered($user));
            Auth::login($user);
            Session::forget('email-user');
            return redirect()->route('boatowner.listing-add')->with('success', 'Registration successful! Please wait for admin approval.');
        }
        else
        {
            event(new NewUserRegistered($user));
            Auth::login($user);
            Session::forget('email-user');
            return redirect()->route('customer.dashboard')->with('success', 'Registration successful!');
        }
    }
}
