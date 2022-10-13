<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RedirectIfLoggedIn
{
    public function handle(Request $request, Closure $next, ...$guards)
    {
        if (isLoggedIn()) {
            return redirect()->route('home');
        }
        return $next($request);
    }
}
