<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    protected $addHttpCookie = true;

    protected $except = [
        //
        'http://localhost/api2/public/user' //This is the url that I dont want Csrf for postman.
    ];
}
