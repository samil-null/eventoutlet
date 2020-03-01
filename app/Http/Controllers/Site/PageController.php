<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Utils\Seo\SEO;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function about()
    {
        SEO::page('about');

        return view('site.pages.about');
    }
}
