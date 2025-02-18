<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Hash;

class AdminLoginController extends Controller
{
    public function index()
    {
        return view('auth.admin.login');  // Create your own login form view
    }
    public function login(Request $request)
    {
        //dd('sdfds');
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Check if the user is an admin
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->back()->withErrors(['email' => 'These credentials do not match our records.']);
    }
    public function profile()
    {
        $active = '';
        $admin = Auth::user();
        return view('auth.admin.profile',compact('active','admin'));
    }
    public function update(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'password' => 'confirmed', 
            'confirm_password' => ''
        ]);
        if($request->password):
            $user->password = Hash::make($request->password); 
        endif;
        $user->name = $request->name;
        if( $user->update()):
            return redirect()->route('admin.dashboard');
        else: 
            return redirect()->route('admin.profile')->with('error', 'Somthing went wrong. Please try again.');
        endif;
    }
    public function logout()
    {
        Auth::logout();  // Logout the user
        return redirect()->route('/');  // Redirect to home after logout
    }
}
