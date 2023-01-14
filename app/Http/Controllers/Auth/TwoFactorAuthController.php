<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Mail\SendOtp;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Mail;
use Otp;

class TwoFactorAuthController extends Controller
{
    public function set(Request $request)
    {
        if (!session()->has('otp')) {
            $this->generate();
        }

        return Inertia::render('Auth/Otp');
    }

    public function check(Request $request)
    {
        if (Otp::validate(auth()->user()->id, $request->otp)->status === true) {
            session(['verifiedOtp' => 1]);

            return redirect(RouteServiceProvider::HOME);
        }
        session(['verifiedOtp' => null]);

        return back()->with('error', 'Verification code: ' . Otp::validate(auth()->user()->id, $request->otp)->error);
    }

    public function resend(Request $request)
    {
        $this->generate();

        return back()->with('success', 'We sent new verification code to your email');
    }

    public function generate()
    {
        Otp::resetAttempt(auth()->user()->id);
        $otp = Otp::generate(auth()->user()->id);
        session(['otp' => $otp]);

        $mailDetails = [
            'subject' => 'Verification code for ' . config('app.name'),
            'body' => 'Your verification code is : ' . $otp
        ];

        Mail::to(auth()->user()->email)->send(new SendOtp($mailDetails));
    }
}
