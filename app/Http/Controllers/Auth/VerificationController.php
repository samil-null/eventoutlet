<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
    public function verify($token)
    {
        $user = User::where([
            'email_verified_token' => $token,
            'email_verified_at' => null,
            'verified' => 0,
        ])->first();

        if ($user) {
            $user->update([
                'email_verified_at' => Carbon::now(),
                'verified' => 1
            ]);
        }

        return redirect()->route('site.home');
    }
}
