<?php

namespace App\Http\Controllers\Api\App;

use App\Filters\UserFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Feedback\FeedbackRequest;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function index(FeedbackRequest $request)
    {
        return response()->json([
            'success' => true
        ]);
    }
}
