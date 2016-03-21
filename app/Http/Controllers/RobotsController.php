<?php

namespace App\Http\Controllers;

class RobotsController extends Controller
{
    public function index ()
    {
        if (!app()->environment('production')) {
            return response("User-agent: *\nDisallow: /", 200)
                ->header('Content-Type', 'text/plain');
        }

        $robots[] = 'User-agent: *';
        $robots[] = 'Allow: /';
        return response(implode("\n", $robots), 200)
            ->header('Content-Type', 'text/plain');
    }
}