<?php

namespace App\Http\Controllers\Site\Lk;

use App\Models\Offer;
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
        $user = $request->user();
        SEO::page('lk.offer.edit');

        $offer = $user->offers()->where(['offers.status' => Offer::ACTIVE_STATUS, 'offers.id' => $id])->first();

        if (!$offer) return redirect()->route('site.lk.profile.show'); 

        return view('site.lk.offers.edit', compact('offer'));
    }
}
