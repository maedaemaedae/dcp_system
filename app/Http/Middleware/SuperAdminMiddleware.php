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
            'role' => optional(auth()->user()->role)->role_name
        ]);
        
        if (auth()->check() && auth()->user()->role && auth()->user()->role->role_name === 'super_admin') {
            return $next($request);
        }

        abort(403, 'Unauthorized access.');
    }
}
