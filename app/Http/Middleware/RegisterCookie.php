<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

/**
 * Class RegisterCookie
 * @package App\Http\Middleware
 */
class RegisterCookie
{
    /**
     * Handle an incoming request.
     * @param Request $request
     * @param Closure $next
     * @return mixed
     * @throws Exception
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Cookie::get('identifier_cookie')) {
            $identifier = (int) microtime() + random_int(1000000, 9999999);
            Cookie::queue('identifier_cookie', $identifier, 2628000);
        }

        return $next($request);
    }
}
