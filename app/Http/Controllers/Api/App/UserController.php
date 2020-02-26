<?php

namespace App\Http\Controllers\Api\App;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends ApiAppController
{
    public function show()
    {
        $user = $this->user->with('info')->first();

        return response()->json([
            'user' => $user
        ]);
    }
}
