<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Speciality\StoreSpecialityRequest;
use App\Models\AdditionFieldSpeciality;
use App\Models\Service;
use App\Models\Specialty;
use App\Services\AdditionsFieldsService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SpecialityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $specialties = Specialty::all();

        return view('admin.specialties.index', compact('specialties'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $speciality = new Specialty();

        return view('admin.specialties.create', compact('speciality'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSpecialityRequest $request)
    {
        $speciality = Specialty::create($request->only('name', 'status'));

        return redirect()->route('admin.specialties.show', $speciality->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $speciality = Specialty::with('fields')->find($id);
        
        return view('admin.specialties.show', compact('speciality'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * @param StoreSpecialityRequest $request
     * @param AdditionsFieldsService $service
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(StoreSpecialityRequest $request, AdditionsFieldsService $service, $id)
    {
        $speciality = Specialty::find($id);
        $service->make($request->input('addition_fields'), $speciality);
        $speciality->update($request->only('name', 'status'));

        return redirect()->route('admin.specialties.show', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Specialty::find($id)->delete();

        return redirect()->route('admin.specialties.index');
    }
}
