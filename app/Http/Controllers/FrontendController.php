<?php

namespace App\Http\Controllers;

class FrontendController extends Controller
{
    public function welcome ()
    {
        return view("welcome");
    }
}