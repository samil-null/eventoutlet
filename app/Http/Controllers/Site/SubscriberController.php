<?php

namespace App\Http\Controllers\Site;

use App\Services\Subscribe\HotNewsletterService;
use App\Http\Requests\Api\Subscriptions\SubscribeRequest;
use App\Mail\Subscribe\NewSubscriber;
use App\Models\Specialty;
use App\Models\User;
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
        $token =  md5($request->input('email'));

        $subscriber = Subscriber::create([
            'email' => $request->input('email'),
            'city_id' => $request->input('city_id'),
            'token'   => $token
        ]);

        $querySpecialty = [];
        $specialtyIds   = [];

        foreach ($request->input('specialities') as $speciality) {
            if ($speciality > 0) {
                $querySpecialty[$speciality] = [
                    'subscriber_id' => $subscriber->id,
                    'specialty_id' => $speciality
                ];

                $specialtyIds[] = $speciality; 
            }
        }

        if (empty($querySpecialty)) {
            foreach (Specialty::where('status', Specialty::ACTIVE_STATUS)->get() as $speciality) {
                $querySpecialty[] = [
                    'subscriber_id' => $subscriber->id,
                    'specialty_id' => $speciality->id
                ];

                $specialtyIds[] = $speciality->id;
            }
        }

        DB::table('subscribers_specialties')->insert($querySpecialty);

        $dateQuery = [];

        foreach ($request->input('dates') as $date) {
            $dateQuery[] = [
                'subscriber_id' => $subscriber->id,
                'date'  => Carbon::create($date)->format('Y-m-d')
            ];
        }

        DB::table('subscribers_dates')->insert($dateQuery);

        //dd(Carbon::now()->diffInDays(collect($request->input('dates'))->min()));
        //dd();


        (new HotNewsletterService())->execute($request->input('dates'), $request->input('city_id'), $specialtyIds);
        Mail::to($request->input('email'))->send(new NewSubscriber($request->input('dates'), $token));


        return response()->json([
            'status' => 500
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

    /**
     * @param string $token
     */
    public function disable(string $token)
    {
        Subscriber::where('token', $token)->update([
            'is_active' => 0
        ]);

        return redirect()->route('site.home');
    }

    /**
     * @param string $token
     */
    public function executorDisable(string $token)
    {
        User::where('email_verified_token', $token)->update([
            'subscription_status' => 0
        ]);

        return redirect()->route('site.home');
    }
}
