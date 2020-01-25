<?php

namespace App\Http\Controllers\Api\App;


use App\Utils\Media\Video;
use App\Models\Media;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Services\ResizeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Api\Media\MediaGalleryRequest;
use App\Http\Requests\Api\Media\MediaVideoRequest;


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
     * @throws \Exception
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

    public function gallery(MediaGalleryRequest $request)
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
                'image'  => $filename
            ]
        ]);
    }

    public function remove(Request $request)
    {
        $f= $request->user()->gallery()->where([
            'type_content' => 'gallery',
            'name' => $request->input('image')
        ])->delete();

        return response()->json([
            'success' => true,
            'data' => [
            ]
        ]);
    }

    public function video(MediaVideoRequest $request, Video $video)
    {

         list($video_path, $thumb_path) = $video->load($request);

        return response()->json([
            'success' => true,
            'data' => [
                'video_path' => asset($video_path),
                'thumb_path' => asset($thumb_path),
            ]
        ]);
    }

    public function render(Request $request)
    {
        return view('api.media.video', [
            'url' => asset('/videos/'. $request->name)
        ]);
    }
}
