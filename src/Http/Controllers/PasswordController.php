<?php

namespace Mixdinternet\Admix\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;

class PasswordController extends Controller
{
    use SendsPasswordResetEmails, ResetsPasswords {
        SendsPasswordResetEmails::broker insteadof ResetsPasswords;
    }

    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showLinkRequestForm()
    {
        return view('mixdinternet/admix::auth.recover');
    }

    public function showResetForm(Request $request, $token = null)
    {
        if (is_null($token)) {
            return $this->showLinkRequestForm();
        }

        return view('mixdinternet/admix::auth.reset')
            ->with(['token' => $token, 'email' => $request->email]);
    }

    public function redirectPath()
    {
        return '/' . config('admin.url');
    }
}
