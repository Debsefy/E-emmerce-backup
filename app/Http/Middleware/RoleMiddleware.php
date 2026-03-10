<?php

// app/Http/Middleware/RoleMiddleware.php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle($request, Closure $next, $role)
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        $user = Auth::user();

        if ($user->role !== $role) {
            return redirect('/unauthorized')->with('error', 'Access Denied');
        }

        if ($role === 'vendor' && $user->status !== 'approved') {
            return redirect('/vendor-pending')->with('error', 'Your account is awaiting approval.');
        }

        return $next($request);
    }

    
}
