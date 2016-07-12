<?php

namespace App\Http\Controllers;
use Session;
use Flash;

class FrontendController extends Controller
{
    public function welcome()
    {
        return view("welcome");
    }

    public function opre()
    {
        Flash::success('Item inserido com sucesso.');

        return redirect('/');
    }

    public function info()
    {
        #-- overkill --
        header('Cache-Control: no-store, private, no-cache, must-revalidate');
        header('Cache-Control: pre-check=0, post-check=0, max-age=0, max-stale = 0', false);
        header('Pragma: public');
        header('Expires: Sat, 26 Jul 1997 05:00:00 GMT');
        header('Expires: 0', false);
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
        header('Pragma: no-cache');

        $info = [];

        #token
        $info['csrf_token'] = csrf_token();

        #mensagens
        if (Session::has('caffeinated.flash.message')) {
            $info['flash']['level'] = Session::get('caffeinated.flash.level');
            $info['flash']['message'] = Session::get('caffeinated.flash.message');

            session()->forget('caffeinated.flash.level');
            session()->forget('caffeinated.flash.message');
        }

        return response()->json($info);
    }
}