<?php namespace App\Http\Middleware;

use Closure;

class RedirectToWwwMiddleware
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (config('admin.www') == false) {
            return $next($request);
        }

        $_server = $request->server();

        $skip = config('admin.skipWww');
        foreach ($skip as $string) {
            if (strpos($_server['HTTP_HOST'], $string) !== false) {
                return $next($request);
            }
        }

        $www = substr($_server['HTTP_HOST'], 0, 3);
        if ($www !== 'www') {
            $redirectTo = config('admin.protocol') . "://www." . $_server['HTTP_HOST'] . "" . $_server['REQUEST_URI'];
            return redirect($redirectTo, 301);
        }

        return $next($request);
    }

}
