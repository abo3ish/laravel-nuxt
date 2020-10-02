<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AssignGuard
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if ($guard != null) {
            auth()->shouldUse($guard);
            if (Auth::check()) {
                return $next($request);
            } else {
                return response()->json([
                    'data' => null,
                    'error' => 'Unauthorized',
                    'code' => 401
                ], 401);
            }
        }
    }
}
