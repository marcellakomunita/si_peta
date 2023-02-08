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
        $ip = $request->ip();

        $allowed_ranges = [
            ['172.24.151.11', '172.24.151.250'],
            ['182.2.0.1', '182.2.255.254'],
        ];
        foreach ($allowed_ranges as $range) {
            if (ip2long($ip) >= ip2long($range[0]) && ip2long($ip) <= ip2long($range[1])) {
                dd('x', $ip, $range);
                return $next($request);
            }
        }

        $allowed_ips = [
            '103.101.52.185', '182.2.42.35'
        ];
        foreach ($allowed_ips as $allowed) {
            if (ip2long($ip) == ip2long($allowed)) {
                dd('y', $ip, $allowed);
                return $next($request);
            }
        }
        dd('z', $ip);

        return abort('401');
    }
}
