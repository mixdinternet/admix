<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Auth;

class AdminAuthenticate extends Authenticate
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        /**
         * TODO: Personalizar a mensagem de usuário inativo
         */

        if(!Auth::user()) {
            return redirect()->route('admin.login.view');
        }

        if (Auth::user()->status === 'inactive') {
            return redirect()->route('admin.logout');
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