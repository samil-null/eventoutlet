<?php

namespace App\Http\Controllers\Admin;

use App\Events\User\ChangeStatus as UserChangeStatus;
use App\Models\City;
use App\Models\Role;
use App\Models\Specialty;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {

        $users = User::filter($request->all())
                    ->orderBy('id', 'DESC')
                    ->paginate(20)
                    ->appends($request->input());

        return view('admin.users.index', [
            'users' => $users,
            'request' => $request
        ]);
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
        $user = User::with('offers', 'services')->findOrFail($id);
        $specialties = Specialty::all();
        $roles = Role::all();
        $cities = City::all();

        return view('admin.users.show', [
            'user'          => $user,
            'roles'         => $roles,
            'specialties'   => $specialties,
            'cities'        => $cities
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
        //
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
        $user = User::find($id);

        if ($user->status != $request->status) {
            event(new UserChangeStatus($request->status, $user));
        }

        $user->info->update(['about_me' => $request->input('about_me')]);

        $roles = Role::whereIn('name', $request->roles)->get();
        $user->syncRoles($roles);

        $user->update($request->only(['status']));

        return redirect()->route('admin.users.show', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);

        $user->gallery()->delete();
        $user->videos()->delete();

        foreach ($user->offers as $offer) {
            $offer->dates()->delete();
        }

        $user->offers()->delete();
        $user->services()->delete();

        $user->delete();

        return redirect()->route('admin.users.index');
    }
}
