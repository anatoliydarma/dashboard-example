<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Role
{
    /**
     * @param Request $request
     * @param Closure $next
     * @return mixed|void
     */
    public function handle(Request $request, Closure $next, string $role)
    {
        if ($request->user()->role === $role || $request->user()->role === 'admin') {
            return $next($request);
        }

        abort(403);
    }
}
