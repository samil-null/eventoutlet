<?php

namespace App\Http\Controllers\Admin;

use App\Events\Offer\OfferChangeStatus;
use App\Helpers\DateHelper;
use App\Http\Controllers\Controller;
use App\Models\Offer;
use App\Models\User;
use App\Transformers\Api\App\OfferTransformer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class OfferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $offer = Offer::find($id);
        $service = $offer->service;

        return view('admin.offers.show', compact('offer', 'service'));
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
        $offer = Offer::find($id);

        if ($offer->status != $request->input('status')) {
            event(new OfferChangeStatus(
                $request->input('status'),
                $offer->user,
                $offer,
                $request->input('message')
            ));
        }

        $offer->update([
            'status' => (int) $request->input('status'),
            'description' => $request->input('description')
        ]);

        return redirect()->route('admin.offers.show', $id);
    }

    public function changeStatuses(Request $request)
    {
        foreach ($request->offers_status as $id => $status) {
            Offer::find($id)->update([
                'status' => $status
            ]);
        }

        return redirect()->back();
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
