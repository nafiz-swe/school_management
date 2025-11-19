<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class VerificationController extends Controller
{
    public function verify(Request $request, $id)
    {
        if (! $request->hasValidSignature()) {
            return redirect('/login')->with('error', 'Invalid or expired verification link!');
        }

        $user = User::find($id);

        if (!$user) {
            return redirect('/login')->with('error', 'User not found!');
        }

        if ($user->email_verified_at) {
            return redirect('/login')->with('info', 'Your account is already activated!');
        }

        $user->email_verified_at = now();
        $user->save();

        return redirect('/login')->with('success', 'Your account has been activated! You can now login.');
    }

}
