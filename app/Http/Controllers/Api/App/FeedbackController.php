<?php

namespace App\Http\Controllers\Api\App;

use App\Filters\UserFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Feedback\FeedbackRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class FeedbackController extends Controller
{
    public function index(FeedbackRequest $request)
    {
        Mail::send('mails.feedback', ['feedback' => $request], function ($message) {
            $message->from('admin@eventoutlet.ru');
            $message->subject('Обратная связь Event outlet');
            $message->to(setting('feedback_email'));
        });

        return response()->json([
            'success' => true
        ]);
    }
}
