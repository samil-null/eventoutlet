<?php

namespace App\Http\Controllers\Api\App;

use App\Factories\Offer\OfferFactory;
use App\Helpers\DateHelper;
use App\Http\Controllers\Controller;
use App\Models\Offer;
use App\Models\PriceOption;
use App\Models\User;
use App\Services\OfferService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Facades\Imager;

class OfferController extends Controller
{
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
    public function create(Request $request)
    {
        $user = $request->user();
        $user = $user->with('speciality')->first();
        $minDate = DateHelper::minFilterDate();
        $maxDate = DateHelper::maxFilterDate();
 
        return response()->json([
            'success' => true,
            'data' => [
                'user' => $user,
                'avatar' => Imager::avatar($user->avatar),
                'services' => Auth::user()->services,
                'min_date' => $minDate,
                'max_date' => $maxDate
            ]
        ]);
    }

    /**
     * @param Request $request
     * @param offerService $offerService
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request, OfferService $offerService)
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
                'offer' => $offer,
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
