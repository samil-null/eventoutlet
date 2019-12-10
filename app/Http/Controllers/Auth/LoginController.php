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

        if ($user->checkPassword($request->input('password'))) {

            Auth::login($user);

            return response()->json([
                'success' => true,
            ]);
        }
    
        return response()->json([
            'success' => false,
        ]);

    }
}
