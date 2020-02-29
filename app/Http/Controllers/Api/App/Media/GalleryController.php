<?php

namespace App\Http\Controllers\Api\App\Media;

use App\Helpers\ImagePathHelper;
use App\Http\Controllers\Api\App\ApiAppController;
use App\Models\Media;
use App\Services\Image\ImageRemoveService;
use App\Services\Image\ImageStoreService;
use App\Transformers\Api\App\GalleryTransformer;
use Illuminate\Http\Request;

class GalleryController extends ApiAppController
{
    public function index(ImageStoreService $storeService)
    {

        $collection = fractal($this->user->gallery, new GalleryTransformer)->toArray();

        return response()->json([
            'gallery' => $collection['data']
        ]);



    }

    public function store(Request $request, ImageStoreService $storeService)
    {
        list($fullPath, $filename) = $storeService->execute($request->file('image'), 'gallery');

        $this->user->gallery()->create([
            'name' => $filename,
            'type' => Media::GALLERY_TYPE
        ]);

        return response()->json([
            'success' => true,
            'data' => [
                'full_path' => asset($fullPath) ,
                'image'  => $filename
            ]
        ]);
    }

    public function destroy(Request $request, ImageRemoveService $removeService)
    {
        $image = $request->input('image');
        $userBuilder = $this->user->gallery()->where('name', $image);
        $exist = $userBuilder->exists();

        if ($exist) {
            $removeService->execute($image, 'gallery');
            $userBuilder->delete();

            return response()->json([
                'success' => true
            ]);
        }

        return response()->json([
            'success' => false
        ]);

    }
}
