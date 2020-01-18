<?php

namespace App\Http\Controllers\Site;

use SEOMeta;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function show($id)
    {
        $user = User::with('offers', 'services')
            ->where('id', $id)
            ->first();

        $user->viewed();

        SEOMeta::setTitle($user->name);

        return view('site.users.show', compact('user'));
    }
}
