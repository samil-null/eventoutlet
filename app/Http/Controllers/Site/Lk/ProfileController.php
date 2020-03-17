<?php

namespace App\Http\Controllers\Site\Lk;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Utils\Seo\SEO;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show()
    {
        SEO::page('lk.show');

        return view('site.lk.profiles.show');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit()
    {
        SEO::page('lk.edit');

        return view('site.lk.profiles.edit');
    }
}
