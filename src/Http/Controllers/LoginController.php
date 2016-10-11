<?php

namespace Mixdinternet\Admix\Http\Controllers;

use App\Http\Controllers\Controller;
use Caffeinated\Flash\Facades\Flash;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    public function showLoginForm()
    {
        return view('mixdinternet/admix::auth.login');
    }

    public function logout(Request $request)
    {
        $error = session('error');

        $this->guard()->logout();

        $request->session()->flush();

        $request->session()->regenerate();

        Flash::error($error);

        return redirect()->route('admin.login.form');
    }

    public function redirectPath()
    {
        return (session()->has('admix.intended')) ? session('admix.intended') : '/' . config('admin.url');
    }
}
