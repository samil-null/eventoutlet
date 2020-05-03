<?php

namespace App\Http\Controllers\Admin;

use App\Events\Service\ServiceChangeStatus;
use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ServiceController extends Controller
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $service = Service::whereId($id)->with('fields.metaField')->first();

        return view('admin.services.edit', compact('service'));
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
        $service = Service::find($id);
        $status = $request->input('status');
        if ($service->status != $status) {
            event(new ServiceChangeStatus($service->user, $request->input('status'), $request->input('message')));
        }

        $service->update($request->only('name', 'seo_name', 'status'));

        return redirect()->route('admin.services.edit', $id);

    }

    public function changeStatuses(Request $request)
    {
        foreach ($request->services_status as $id => $status) {
            Service::find($id)->update([
                'status' => $status
            ]);
        }
        
        $user = User::find($request->input('user_id'));
        
        Mail::send('mails.service.change_status', ['services' => $user->services], function ($message) use ($user) {
            $message->from('admin@eventoutlet.ru');
            $message->subject('Subject');
            $message->to($user->email);
        });
        
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
