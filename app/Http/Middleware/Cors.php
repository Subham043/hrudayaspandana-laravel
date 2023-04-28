<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Cors
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
        $response = $next($request);

        $allowedOrigins = [env('MAIN_FRONTEND_ENDPOINT', 'http://localhost:3000'), env('ADMIN_FRONTEND_ENDPOINT', 'http://localhost:62002')];
        $origin = $request->server('HTTP_ORIGIN');

        if (in_array($origin, $allowedOrigins)) {
            $headers = [
                'Access-Control-Allow-Origin' => $origin,
                'Access-Control-Allow-Methods' => 'GET', 'POST', 'PUT', 'PATCH', 'DELETE', 'OPTIONS',
                'Access-Control-Allow-Headers' => 'X-Requested-With, Content-Type, X-Token-Auth, Authorization, Accept, Application',
            ];

            foreach($headers as $key => $value) {
                $response->headers->set($key, $value);
            }
            $response->headers->set('Content-Security-Policy', "default-src 'self';style-src 'self';script-src 'self';font-src 'self';object-src 'self';img-src 'self' ".$origin.";frame-src 'self' ".$origin.";frame-ancestors 'self' ".$origin.";connect-src 'self' ".$origin.";form-action 'self';base-uri 'self';script-src-attr 'none';upgrade-insecure-requests");
            return $response;
        }else{
            $response->headers->set('Content-Security-Policy', "default-src 'self';style-src 'self';script-src 'self';font-src 'self';object-src 'self';img-src 'self';frame-src 'self';frame-ancestors 'self';connect-src 'self';form-action 'self';base-uri 'self';script-src-attr 'none';upgrade-insecure-requests");
            return $response;
        }

    }
}
