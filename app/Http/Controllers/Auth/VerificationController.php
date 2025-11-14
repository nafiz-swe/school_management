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
            return "Invalid or expired verification link!";
        }

        $user = User::find($id);

        if (!$user) {
            return "User not found!";
        }

        if ($user->email_verified_at) {
            return "Your account is already activated!";
        }

        // Update verified time
        $user->email_verified_at = Carbon::now();
        $user->save(); // ✅ use save() instead of update() to ensure working

        return "✅ Your account has been activated! You can now login.";
    }
}
