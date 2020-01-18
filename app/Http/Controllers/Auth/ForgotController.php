<?php

namespace App\Http\Controllers\Auth;

use App\Events\User\UserForgotPassword;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ForgotRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ForgotController extends Controller
{
    public function forgot(ForgotRequest $request)
    {
        $user = User::where('email', $request->input('email'))->first();

        if ($user) {

            $token = Str::random(54);
            $user->update(['remember_token' => $token]);
            event(new UserForgotPassword($user, $token));
        }

        return response()->json([
            'success' => true,
        ]);
    }

    public function remember($token)
    {
        $user = User::where('remember_token', $token)
                ->whereNotNull('remember_token')
                ->first();

        if ($user) {
            echo "good";
        } else {
            return redirect()->route('site.home');
        }
    }
}
