<?php namespace App\Http\Middleware;

use Closure;

class ForceUrlMiddleware
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
        $_server = $request->server();

        $protocol = ($_server['SERVER_PORT'] == 443) ? 'https://' : 'http://';
        $url = $protocol . $_server['HTTP_HOST'];

        if (config('app.url') == $url) {
            return $next($request);
        }

        return redirect(config('app.url'), 301);
    }
}
