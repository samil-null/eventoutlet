<?php


namespace App\Http\Controllers\Api\App\Media;


use App\Helpers\ImagePathHelper;
use App\Http\Controllers\Api\App\ApiAppController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AvatarController extends ApiAppController
{
    public function store(Request $request)
    {
        if ($this->user->avatar) {
            Storage::delete('images/avatar/original/'. $this->user->avatar);
        }

        $avatar = $request->file('avatar');
        $filename = ImagePathHelper::generateFileName($avatar->getClientOriginalExtension());

        $this->user->update(['avatar' => $filename]);
        $path = $avatar->storeAs('images/avatar/original/', $filename);

        return response()->json([
            'avatar' => asset($path)
        ]);
    }
}
