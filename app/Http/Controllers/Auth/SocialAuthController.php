<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class SocialAuthController extends Controller
{
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    // Handle Facebook Callback
    public function handleFacebookCallback()
    {
        $user = Socialite::driver('facebook')->user();

        // Check if the user exists in the database
        $existingUser = User::where('provider_id', $user->getId())->first();

        if (!$existingUser) {
            $existingUser = User::create([
                'name' => $user->getName(),
                'email' => $user->getEmail(),
                'role' => session()->get('role'),
                'provider' => 'facebook',
                'provider_id' => $user->getId(),
                'avatar' => $user->getAvatar(),
            ]);
        }

        Auth::login($existingUser);
        return redirect()->to('/home');
    }

    // Redirect to Google
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    // Handle Google Callback
    public function handleGoogleCallback()
    {
        $user = Socialite::driver('google')->user();
        //dd($user->getId());
        // Check if the user exists in the database
        $existingUser = User::where('provider_id', $user->getId())->first();

        if (!$existingUser) {
            $existingUser = User::create([
                'name' => $user->getName(),
                'email' => $user->getEmail(),
                'role' => session()->get('role'),
                'provider' => 'google',
                'provider_id' => $user->getId(),
            ]);
        }

        Auth::login($existingUser);
        return redirect()->route('customer.dashboard');
    }

    // Redirect to Apple
    public function redirectToApple()
    {
        return Socialite::driver('apple')->redirect();
    }

    // Handle Apple Callback
    public function handleAppleCallback()
    {
        $user = Socialite::driver('apple')->user();

        // Check if the user exists in the database
        $existingUser = User::where('provider_id', $user->getId())->first();

        if (!$existingUser) {
            $existingUser = User::create([
                'name' => $user->getName(),
                'email' => $user->getEmail(),
                'provider' => 'apple',
                'provider_id' => $user->getId(),
                'avatar' => $user->getAvatar(),
            ]);
        }

        Auth::login($existingUser);
        return redirect()->to('/home');
    }
}
