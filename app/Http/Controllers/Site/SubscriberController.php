<?php

namespace App\Http\Controllers\Site;

use App\Http\Requests\Api\Subscriptions\SubscribeRequest;
use App\Mail\Subscribe\NewSubscriber;
use Mail;
use DB;
use App\Http\Controllers\Controller;
use App\Models\Subscriber;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SubscriberController extends Controller
{
    /**
     * @param SubscribeRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function subscribe(SubscribeRequest $request)
    {
        $token =  Str::random(54);

        $subscriber = Subscriber::create([
            'email' => $request->input('email'),
            'city_id' => $request->input('city_id'),
            'date'    => Carbon::create($request->input('date'))->format('Y-m-d'),
            'token'   => $token
        ]);

        $query = [];

        foreach ($request->input('specialities') as $speciality) {
            if ($speciality > 0) {
                $query[$speciality] = [
                    'subscriber_id' => $subscriber->id,
                    'speciality_id' => $speciality
                ];
            }
        }

        if (!empty($query)) {
            DB::table('subscribers_specialties')->insert($query);
        }

        Mail::to($request->input('email'))->send(new NewSubscriber(Carbon::create($request->input('date'))->format('d.m.Y'), $token));

        return response()->json([
            'status' => 200
        ]);
    }

    /**
     * @param string $token
     */
    public function enable(string $token)
    {
        Subscriber::where('token', $token)->update([
            'is_active' => 1
        ]);

        return redirect()->route('site.home');
    }
}
