<?php

function checkActive($route = '')
{
    $url = parse_url($route);
    $path = trim($url['path'], '/');
    return request()->is($path . '*');
}

function checkRule($rules = [])
{
    $user = auth()->user();

    if ($user->role_id == 0) {
        return false;
    }

    if (auth()->user()->role()->first() == null) {
        return true;
    }

    if (!is_array($rules)) $rules = [$rules];

    foreach ($rules as $rule) {
        if (in_array($rule, auth()->user()->role()->first()->rules)) {
            return false;
        }
    }

    return true;
}