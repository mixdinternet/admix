<?php namespace App\Http\Middleware;

use Closure;
use Spatie\ResponseCache\ResponseCache;

class ForceReflashMiddleware
{
    /**
     * @var \Spatie\ResponseCache\ResponseCache
     */
    protected $responseCache;

    public function __construct(ResponseCache $responseCache)
    {
        $this->responseCache = $responseCache;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        if ($this->responseCache->shouldCache($request, $response)) {
            session()->reflash();
        }

        return $response;
    }
}
