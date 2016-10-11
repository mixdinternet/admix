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

    $userRules = auth()->user()->role()->first()->rules;
    foreach ($rules as $rule) {
        if (in_array($rule, $userRules)) {
            return false;
        }
    }

    return true;
}

function columnSort($title, $parameters, $icon = 'fa-sort')
{
    $field = request()->get('field');
    $sort = request()->get('sort');

    if ($sort == 'asc') {
        $parameters['sort'] = 'desc';
    } else {
        $parameters['sort'] = 'asc';
    }

    if ($field == $parameters['field']) {
        $icon = sprintf('fa %s-%s', $icon, $parameters['sort']);
    } else {
        $icon = sprintf('fa %s', $icon);
    }

    $queryString = request()->getQueryString();
    parse_str($queryString, $query);
    unset($query['page']);
    unset($query['field']);
    unset($query['sort']);
    $fullUrl = request()->url() . '?' . http_build_query($query + $parameters);


    return sprintf('<a href="%s">%s <i class="%s"></i></a>', $fullUrl, $title, $icon);
}