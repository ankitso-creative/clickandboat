<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Validation\Rules\Password as RulesPassword;

class ResetPasswordController extends Controller
{
    /**
     * Show the form to reset the password.
     *
     * @param  string  $token
     * @return \Illuminate\View\View
     */
    public function showResetForm($token)
    {
        return view('auth.reset-password', ['token' => $token]);
    }

    /**
     * Reset the given user's password.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function reset(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' =>['required','confirmed',RulesPassword::min(8)->mixedCase()->letters()->numbers()->symbols()],
            'token' => 'required',
        ]);

        $response = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user) use ($request) {
                // Update the user's password
                $user->forceFill([
                    'password' => Hash::make($request->password),
                ])->save();

                // Fire the password reset event
                event(new PasswordReset($user));
            }
        );

        if ($response == Password::PASSWORD_RESET) {
            return redirect()->route('login')->with('status', trans($response));
        }

        return back()->withErrors(['email' => trans($response)]);
    }
}
