<?php

namespace App\Http\Controllers\Auth;

use Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function index(LoginRequest $request)
    {
        $user = User::where('email', $request->input('email'))->first();

        if ($user && $user->checkPassword($request->input('password')) && $user->status != User::BANED_STATUS) {

            Auth::login($user);

            return response()->json([
                'success' => true,
                'to' => $user->hasRole('admin')?route('admin.dashboard') : route('site.lk.profile.show')
            ]);
        }

        return response()->json([
            'success' => false,
            'to' => route('site.home')
        ]);

    }
}
