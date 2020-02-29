<?php

namespace App\Http\Controllers\Api\App;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends ApiAppController
{
    public function index()
    {
        return response()->json([
            'user' => $this->user
        ]);
    }

    public function update(Request $request)
    {

    }
}
