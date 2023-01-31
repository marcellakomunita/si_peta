<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckIPAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $libraryIpRange = env('ALL_IP'); // Example IP range
        if (!in_array($_SERVER['REMOTE_ADDR'], explode('/', $libraryIpRange)) && $request->path() !== 'unauthorized') {
            dd($_SERVER['REMOTE_ADDR']);
            return abort(401);
        }

        return $next($request);
    }
}
