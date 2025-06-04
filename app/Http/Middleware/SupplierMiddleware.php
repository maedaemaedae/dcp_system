<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SupplierMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check() && auth()->user()->role_id === 6) {
            return $next($request);
        }

        abort(403, 'Unauthorized access.');
    }
}
