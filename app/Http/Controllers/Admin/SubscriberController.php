<?php


namespace App\Http\Controllers\Admin;


use App\Models\Subscriber;

class SubscriberController
{
    public  function index()
    {
        return view('admin.subscribers.index', [
            'subscribers' => Subscriber::with('dates', 'specialities.speciality')->orderBy('created_at', 'desc')->paginate(20)
        ]);
    }
}
