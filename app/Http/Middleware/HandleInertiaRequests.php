<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     *
     * @return string|null
     */
    public function version(Request $request)
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @return array
     */
    public function share(Request $request)
    {
        return array_merge(parent::share($request), [
            'auth.user' => fn () => $request->user()
                ? $request->user()->only('id', 'full_name', 'email', 'role', 'permission')
                : null,
            'app' => [
                'name' => config('app.name'),
                'env' => config('app.env'),
            ],
            'flash' => [
                'success' => $request->session()->get('success'),
                'error' => $request->session()->get('error'),
                'warn' => $request->session()->get('warning'),
            ],
        ]);
    }
}
