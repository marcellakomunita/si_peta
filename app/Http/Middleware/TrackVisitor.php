<?php

namespace App\Http\Middleware;

use App\Http\Controllers\VisitorController;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TrackVisitor
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
        $controller = new VisitorController();
        $controller->store($request);

        return $next($request);
    }
}
