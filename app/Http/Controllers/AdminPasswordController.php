<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Auth\PasswordController;

class AdminPasswordController extends PasswordController
{

    public function __construct()
    {
        $this->redirectPath = route('admin.dashboard');
        $this->subject = "Reset de senha";
    }

    public function recoverView()
    {
        return view("admin.recover");
    }

    public function getReset($token = null)
    {
        if (is_null($token)) {
            throw new NotFoundHttpException;
        }

        return view('admin.reset')->with('token', $token);
    }
}