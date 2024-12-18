<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\ForgotPassword; // Make sure to import your Mailable
use Illuminate\Support\Facades\Hash;



class AuthController extends Controller
{
    // Show the forgot password form
    public function showForgotPasswordForm()
    {
        return view('auth.forgot-password'); // Your forgot password view
    }

    // Handle the form submission and send the reset link
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $response = Password::sendResetLink(
            $request->only('email')
        );

        // Optional: Customize the response message
        if ($response == Password::RESET_LINK_SENT) {
            return back()->with('status', trans($response));
        } else {
            return back()->withErrors(['email' => trans($response)]);
        }
    }

    // Show the reset password form
    public function showResetForm($token)
    {
        return view('resetpassword', ['token' => $token]);
    }

    // Handle the password reset
    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
            'token' => 'required'
        ]);

        $resetStatus = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user) use ($request) {
                $user->password = Hash::make($request->password);
                $user->save();
            }
        );

        if ($resetStatus == Password::PASSWORD_RESET) {
            return redirect('/login')->with('status', trans($resetStatus));
        } else {
            return back()->withErrors(['email' => trans($resetStatus)]);
        }
    }
}
