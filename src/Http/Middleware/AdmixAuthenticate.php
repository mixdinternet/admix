<?php

namespace Mixdinternet\Admix\Http\Middleware;

use Closure;
use Flash;

class AdmixAuthenticate
{
    public function handle($request, Closure $next)
    {
        if (!auth()->user()) {
            session(['admix.intended' => url()->current()]);
            return redirect()->route('admin.login.form');
        }

        if (auth()->user()->status === 'inactive') {
            return redirect()->route('admin.logout')->with(['error' => 'Usuário inativo']);
        }

        /*if ($this->auth->guest()) {
            if ($request->ajax()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->route('admin.login.view');
            }
        }*/

        return $next($request);
    }
}