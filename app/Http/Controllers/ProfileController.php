<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Services\UserService;
use Inertia\Inertia;

class ProfileController extends Controller
{
    public function edit()
    {
        return Inertia::render('Users/Profile', [
            'user' => auth()->user(),
            'action' => route('profile.update'),
            'roles' => config('constants.roles'),
        ]);
    }

    public function update(UserRequest $request, UserService $userService)
    {
        $user = auth()->user();

        $userService->update($user, $request);

        return back()->with('success', 'User saved');
    }
}
