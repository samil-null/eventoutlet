<?php

namespace App\Http\Controllers\Admin;

use App\Events\User\UserChangeStatus;
use App\Filters\UserFilter;
use App\Models\City;
use App\Models\Role;
use App\Models\Service;
use App\Models\Specialty;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Services\UserFilterService;
use Illuminate\Http\Request;

class UserController extends Controller
{

    /**
     * @var UserFilterService
     */
    private $filter;

    public function __construct(UserFilterService $filter)
    {
        $this->filter = $filter;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request, UserFilter $filter)
    {

        $users = User::filter($filter)->paginate(20);

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
        //
    }
}
