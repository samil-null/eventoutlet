<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index(RegisterRequest $request)
    {
        //create new user
        $user = User::create([
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password'))
        ]);
        
        //attache role
        $user->attachRole('executor');

        return response()->json([
            'success' => true
        ]);
    }
}
