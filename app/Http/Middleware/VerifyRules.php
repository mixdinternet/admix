<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class VerifyRules
{

    public function handle($request, Closure $next)
    {
        $actions = $request->route()->getAction();
        if(!isset($actions['as'])){
            return redirect()->route('admin.notFound');
        }

        $rule = str_replace(['.store', '.update', '.restore'], ['.create', '.edit', '.trash'], $actions['as']);
        if(checkRule($rule)){
            return redirect()->route('admin.notFound');
        }

        return $next($request);
    }
}