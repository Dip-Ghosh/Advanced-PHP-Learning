<?php

namespace App\Http\Middleware;

use App\Enums\Roles;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckUserRole
{
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if ($request->user()->role !== Roles::from($role)) {
            return redirect()->route('dashboard');
        }

        return $next($request);
    }
}
