<?php

namespace App\Http\Controllers\Api\App;


use Auth;
use App\Models\City;
use App\Models\User;
use App\Models\UserInfo;
use App\Models\Specialty;

use App\Utils\Media\Video;
use App\Models\PriceOption;
use Illuminate\Http\Request;
use App\Services\ResizeService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Profile\UpdateRequest;

class ProfileController extends Controller
{

    private $resize;

    public function __construct(ResizeService $resize)
    {
        $this->resize = $resize;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

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
        $user = User::with(['offers.service'])->where('id', $id)->first();

        return response()->json([
            'success' => true,
            'data' => [
                'user' => $user,
            ]
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Video $video, $id)
    {
        $user = User::with(
            'info','services.priceOption', 'city',
            'speciality','speciality.fields', 'offers', 'offers'
        )->find($id);

        abort_if(!$user, 404);

        $specialties = Specialty::where('status', Specialty::ACTIVE_STATUS)->get(['id', 'name']);
        $priceOptions = PriceOption::all(['id', 'name']);
        $cities = City::where('status', City::ACTIVE_STATUS)->get();
        $genders = (new UserInfo())->genders;
        $videos = $video->take($user->videos);

        $gallery = $user->gallery->map(function ($image)  {
            return [
                'full_path' => $this->resize->getFileUrl($image->name, 'gallery'),
                'image' => $image->name
            ];
        });

        return response()->json([
            'success' => true,
            'data' => [
                'user' => $user,
                'specialties' => $specialties,
                'price_options' => $priceOptions,
                'avatar' => $this->resize->roc($user->avatar, 'avatar', 'avatar'),
                'gallery' => $gallery,
                'videos' => $videos,
                'cities' => $cities,
                'genders' => $genders
            ]
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Api\Profile\UpdateRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id)
    {
        $user = User::find($id);
        $user->update([
            'name' => $request->input('name'),
            'status' => User::WAITING_STATUS
        ]);
        $user->info()->update($request->except('name'));

        return response()->json([
            'success' => true,
            'user' => $user
        ]);
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
