<?php


namespace App\Http\Controllers\Api\App;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ApiAppController extends Controller
{
    protected $user;

    protected $userBuilder;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (Auth::check()) {
                $this->userBuilder = User::where('id', Auth::id());
                $this->user = Auth::user();
                return $next($request);
            }
            
            abort(403);
        });
    }
}
