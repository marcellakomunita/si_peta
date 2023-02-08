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
        $ip = $_SERVER['REMOTE_ADDR'];
        // dd(ip2long($ip));
        $libraryIpRangeStart = '172.24.151.11';
        $libraryIpRangeEnd = '172.24.151.250';
        $testIp = ['103.101.52.185', '182.2.68.230'];
        $ip_in_range = false;
        if (ip2long($ip) >= ip2long($libraryIpRangeStart) && ip2long($ip) <= ip2long($libraryIpRangeEnd)) {
            $ip_in_range = true;
        }
        
        if (in_array($ip, $testIp)) {
            $ip_in_range = true;
        }

        if (!$ip_in_range && $request->path() !== 'unauthorized') {
            return abort('401');
        }

        return $next($request);
    }
}
