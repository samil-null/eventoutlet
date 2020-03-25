<?php

namespace App\Http\Controllers\Api\App;

use App\Helpers\SocialHelper;
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
use Illuminate\Support\Facades\Auth;

class ProfileController extends ApiAppController
{

    private $resize;

    public function __construct(ResizeService $resize)
    {
        parent::__construct();
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
    public function show(Request $request)
    {

        $user = $this->user->with(['offers.service'])->first();

        return response()->json([
            'success' => true,
            'data' => [
                'user' => $user,
                'avatar' => $this->resize->roc($user->avatar, 'avatar', 'avatar')
            ]
        ]);
    }

    /**
     * @param Video $video
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function edit(Video $video, $id)
    {

        $user = $this->userBuilder->with([ 'info','services.priceOption', 'services.fields.metaField', 'city', 'speciality.fields', 'offers'])
                            ->first();

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
                'genders' => $genders,
                'user_types' => (new UserInfo())->user_types
            ]
        ]);
    }

    /**
     * @param UpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateRequest $request, $id)
    {
        $user = $this->user;

        $user->update([
            'name' => $request->input('name')
        ]);

        UserInfo::where('user_id', $user->id)->first()
                ->update($request->except('name'));

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
