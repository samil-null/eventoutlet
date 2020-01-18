<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Speciality\StoreSpecialityRequest;
use App\Models\AdditionFieldSpeciality;
use App\Models\Service;
use App\Models\Specialty;
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreSpecialityRequest $request, $id)
    {
        $speciality = Specialty::find($id);

        if ($request->has('addition_fields')) {

            foreach ($request->input('addition_fields') as $field) {
                if (!$field['key']) {

                    $field['key'] = Str::random(50);
                    $speciality->fields()
                        ->save(new AdditionFieldSpeciality($field));
                } else {
                    $additionField = $speciality->fields()
                        ->where('key', $field['key'])
                        ->first()
                        ->update($field);
                }
            }

        }

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
