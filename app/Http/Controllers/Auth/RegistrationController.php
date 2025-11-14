<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Carbon\Carbon;

class RegistrationController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users',
            'password' => 'required|min:6'
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // 5 মিনিট validity সহ signed URL
        $verifyLink = URL::temporarySignedRoute(
            'verify', 
            now()->addMinutes(5), // 5 মিনিট valid
            ['id' => $user->id]
        );

        // সুন্দর email body
        $emailBody = "
        Hi {$user->name},

        Welcome to School Management System! 🎉

        Please click the link below to activate your account. 
        Note: This link will expire in 5 minutes.

        Activate your account: $verifyLink

        Thank you,
        School Management Team
        ";

        Mail::raw($emailBody, function ($message) use ($user) {
            $message->to($user->email)
                    ->subject('Activate Your Account - 5 Minutes Valid');
        });

        return back()->with('success', 'Registration successful! Check your email to activate your account (valid for 5 minutes).');
    }
}
