<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class VerifyOtp
{
    /**
     * @return mixed|void
     */
    public function handle(Request $request, Closure $next)
    {
        if (config('2fa.otp_is_on')) {
            if (session()->missing('verifiedOtp')) {
                return redirect()->route('otp.set');
            }
        }

        return $next($request);
    }
}
