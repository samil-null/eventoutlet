<?php

namespace App\Http\Middleware;

use Closure;

class LkGuard
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->route('profile') == $request->user()->id) {
            return $next($request);
        } else {
            return redirect()->route('site.lk.profiles.show', $request->user()->id);
        }
    }
}
