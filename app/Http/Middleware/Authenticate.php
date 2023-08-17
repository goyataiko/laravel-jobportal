<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        // 잘 되면 그대로 null이지만, 인증이 안되면 login페이지로 이동
        return $request->expectsJson() ? null : route('login');
    }
}
