<?php

if (! function_exists('auth_user')) {
    function auth_user()
    {
        return Auth::user() ?? request()->user('api');
    }
}
