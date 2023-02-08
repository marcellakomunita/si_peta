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
    protected function isValidIp($ip) {
        return preg_match("/^(\d{1,3})\.(\d{1,3})\.(\d{1,3})\.(\d{1,3})$/", $ip) && count(array_filter(explode('.', $ip), function($v) { return ($v >= 0 && $v <= 255); })) === 4;
    }
    public function handle(Request $request, Closure $next)
    {
        $ip = $_SERVER['HTTP_X_ENVOY_EXTERNAL_ADDRESS'] ?? $_SERVER['HTTP_X_FORWARDED_FOR'] ?? '';
        $ip = explode(',', $ip)[0];
        $ip = trim($ip);
        
        if(!$this->isValidIp($ip)) {
            return abort('401');
        }

        $allowed_ranges = [
            ['172.24.151.11', '172.24.151.250'],
            ['182.2.0.1', '182.2.255.254'],
        ];
        foreach ($allowed_ranges as $range) {
            if (ip2long($ip) >= ip2long($range[0]) && ip2long($ip) <= ip2long($range[1])) {
                return $next($request);
            }
        }

        $allowed_ips = [
            '103.101.52.185', '182.2.42.35'
        ];
        foreach ($allowed_ips as $allowed) {
            if (ip2long($ip) == ip2long($allowed)) {
                return $next($request);
            }
        }

        return abort('401');
    }
}
