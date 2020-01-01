<?php

namespace App\Http\Controllers\Api\App;

use App\Models\Media;
use App\Http\Controllers\Controller;
use App\Services\ResizeService;
use Illuminate\Http\Request;


class MediaController extends Controller
{
    /**
     * @var ResizeService
     */
    private $resize;

    /**
     * MediaController constructor.
     * @param ResizeService $resize
     */
    public function __construct(ResizeService $resize)
    {
        $this->resize = $resize;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function avatar(Request $request)
    {
        if ($request->hasFile('avatar')) {

            $user = $request->user();

            list($fullPath, $filename) = $this->resize->store($request->file('avatar'), 'avatar');

            if ($user->avatar) {
               $this->resize->remove($user->avatar, 'avatar');
            }

            $user->update(['avatar' => $filename]);

            return response()->json([
                'success' => true,
                'data' => [
                    'path' => asset($fullPath),
                    'image' => $this->resize->roc($user->avatar, 'avatar', 'avatar')
                ]
            ]);
        }

        return response()->json([
            'success' => false
        ]);
    }

    public function gallery(Request $request)
    {
        $user = $request->user();

        list($fullPath, $filename) = $this->resize->store($request->file('image'), 'gallery');

        $user->gallery()->save(new Media([
            'type' => 'image',
            'type_content' => 'gallery',
            'name'  => $filename
        ]));

        return response()->json([
            'success' => true,
            'data' => [
                'full_path' => asset($fullPath) ,
                'filepath'  => $filename
            ]
        ]);
    }
}
