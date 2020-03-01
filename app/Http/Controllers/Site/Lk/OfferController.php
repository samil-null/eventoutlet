<?php

namespace App\Http\Controllers\Site\Lk;

use App\Http\Controllers\Controller;
use App\Utils\Seo\SEO;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        SEO::page('lk.offer.create');

        return view('site.lk.offers.create');
    }

    public function edit(Request $request, $id)
    {
        SEO::page('lk.offer.edit');

        $offer = $request->user()->offers()->findOrFail($id);

        return view('site.lk.offers.edit', compact('offer'));
    }
}
