<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        $user = $request->user();

        // Map role names to IDs
        $roleNameToId = [
            'super_admin' => 1,
            'admin' => 2,
            'regional_office' => 3,
            'division_office' => 4,
            'school' => 5,
            'supplier' => 6,
        ];

        $allowedRoleIds = array_map(fn($r) => $roleNameToId[$r] ?? null, $roles);

        if (!$user || !in_array($user->role_id, $allowedRoleIds)) {
            abort(403, 'Unauthorized');
        }

        return $next($request);
    }
}
