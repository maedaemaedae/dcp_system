<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SuperAdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        \Log::info('User Role:', [
            'id' => auth()->id(),
            'role_id' => auth()->user()?->role_id,
        ]);

        if (auth()->check() && auth()->user()->role_id === 1) {
            return $next($request);
        }

        abort(403, 'Unauthorized access.');
    }
}
