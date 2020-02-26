<?php

namespace App\Http\Controllers\Api\App;

use App\Factories\Offer\OfferFactory;
use App\Helpers\DateHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Offer\StoreOffer;
use App\Models\Offer;
use App\Models\PriceOption;
use App\Models\User;
use App\Services\OfferService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Facades\Imager;

class OfferController extends ApiAppController
{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = $request->user();
        $data = $user->offers()->with('service.priceOption','dates')->get();

        $offers = (new OfferFactory($data))->create();

        return response()->json([
            'success' => true,
            'data' => [
                'offers' => $offers
            ]
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = $this->user->with('speciality')->first();

        $minDate = DateHelper::minFilterDate();
        $maxDate = DateHelper::maxFilterDate();

        return response()->json([
            'success' => true,
            'data' => [
                'user' => $user,
                'avatar' => Imager::avatar($user->avatar),
                'services' => Auth::user()->services,
                'minDate' => $minDate,
                'maxDate' => $maxDate
            ]
        ]);
    }

    /**
     * @param Request $request
     * @param offerService $offerService
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreOffer $request, OfferService $offerService)
    {
        $offer = $offerService->create($request->user(), $request);
        return response()->json([
            'data' => [
                'url' => route('site.lk.offers.edit', $offer->id)
            ]
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,  $id)
    {
        $user = $request->user();
        $offer = $user->offers()->with('dates')->findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => [
                'offer' => $offer
            ]
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * @param StoreOffer $request
     * @param $id
     * @param OfferService $offerService
     */
    public function update(StoreOffer $request, $id, OfferService $offerService)
    {
        $user = $request->user();

        $offerService->update($user->offers()->find($id), $request);

    }

    public function published(Request $request, OfferService $offerService)
    {
        $offerService->published(
            $request->input('published'),
            $request->user()
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $user = $request->user();
        $offer = $user->offers()->find($id);

        if ($offer) {
            $offer->delete();
        }
    }
}
