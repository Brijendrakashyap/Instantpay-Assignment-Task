<?php
// app/Http/Middleware/Authenticate.php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    protected function redirectTo($request)
    {
        // Return 401 Unauthorized if the request is an API request
        if (!$request->expectsJson()) {
            return route('login'); // Only for web-based applications
        }

        // Return null for API requests to prevent redirect
        return null;
    }
}
