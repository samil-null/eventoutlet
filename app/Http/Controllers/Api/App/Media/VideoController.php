<?php

namespace App\Http\Controllers\Api\App\Media;

use App\Http\Controllers\Api\App\ApiAppController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Media\VideoRequest;
use App\Models\Media;
use App\Services\Video\VideoRemoveService;
use App\Services\Video\VideoStoreService;
use App\Transformers\Api\App\VideoTransformer;
use Illuminate\Http\Request;

class VideoController extends ApiAppController
{
    public function index()
    {
        $resource = fractal($this->user->videos, new VideoTransformer)->toArray();

        return response()->json([
            'videos' => $resource['data']
        ]);
    }

    public function store(VideoRequest $request, VideoStoreService $storeService)
    {
        list($video_path, $thumb_path) = $storeService->execute($request->post('link'), $this->user);

        return response()->json([
            'video' => [
                'video' => $video_path,
                'thumb' => $thumb_path,
            ]
        ]);

        return response()->json([
            'response' => 'sdwdwedweefwerfw'
        ]);
    }

    public function destroy(Request $request, VideoRemoveService $removeService)
    {
        $video = $request->input('video');
        $builder = $this->user->videos()->where('name', $video);

        if ($builder->count()) {
            $removeService->execute($video);
            $builder->delete();

            return response()->json([
                'success' => true
            ]);
        }
        return response()->json([
            'success' => false
        ]);
    }

    public function render(Request $request)
    {
        return view('api.media.video', [
            'url' => asset('/videos/'. $request->name)
        ]);
    }
}
