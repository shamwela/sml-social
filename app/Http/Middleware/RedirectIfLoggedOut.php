<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RedirectIfLoggedOut
{
    public function handle(Request $request, Closure $next)
    {
        if (!is_logged_in()) {
            return redirect()->route('auth.register.show');
        }
        return $next($request);
    }
}
