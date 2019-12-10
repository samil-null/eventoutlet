<?php

namespace App\Http\Controllers\Auth;

use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LogoutController extends Controller
{
    public function index()
    {
        Auth::logout();

        return redirect()->route('site.home');
    }
}
