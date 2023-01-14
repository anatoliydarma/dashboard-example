<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsOn
{
    /**
     * @return mixed|void
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->user()->isOn()) {
            return $next($request);
        }

        abort(403);
    }
}
