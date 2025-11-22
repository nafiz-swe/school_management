<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;

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

        $verifyLink = URL::temporarySignedRoute(
            'verify', 
            now()->addMinutes(5),
            ['id' => $user->id]
        );

        $emailBody = "
        Hi {$user->name},
        Please click below to activate your account (valid 5 mins):
        $verifyLink
        ";

        Mail::raw($emailBody, function($message) use ($user){
            $message->to($user->email)
                    ->subject('Activate Your Account');
        });

        return back()->with('success', 'Registration successful! Check your email to activate your account.');
    }
}
