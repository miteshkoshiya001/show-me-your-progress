<?php

namespace App\Http\Middleware;

use App\Helpers\Helper;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AppLanguage
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $apiLocale = $request->header('locale') ?? app()->getLocale();
        if (in_array($apiLocale, Helper::getLocales())) {
            app()->setLocale($apiLocale);
        }
        return $next($request);
    }
}
