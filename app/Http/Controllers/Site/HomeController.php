<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Specialty;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $specialities = (new Specialty())
            ->active()
            ->get()
            ->toJson();
        return view('site.home.index',[
            'specialities' => $specialities
        ]);
    }
}
