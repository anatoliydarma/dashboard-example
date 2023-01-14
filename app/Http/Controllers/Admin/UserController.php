<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::when(request('search'), function ($query, $search) {
            $query->where('first_name', 'like', '%'.$search.'%')
                    ->orWhere('last_name', 'like', '%'.$search.'%')
                    ->orWhere('email', 'like', '%'.$search.'%');
        })
        ->paginate(15);

        $users->getCollection()->transform(function ($user, $key) { // @phpstan-ignore-line
            return [
                'id' => $user->id,
                'first_name' => $user->first_name,
                'last_name' => $user->last_name,
                'email' => $user->email,
                'role' => $user->role,
                'is_on' => (bool) $user->is_on,
                'purchaser' => (bool) $user->purchaser,
                'added_at' => $user->created_at->rawFormat('D, d M Y'),
            ];
        });

        return Inertia::render('Users/Index', [
            'users' => $users,
            'filters' => $request->only('search'),
            'roles' => config('constants.roles'),
        ]);
    }

    public function create()
    {
        return Inertia::render('Users/Profile', [
            'user' => [],
            'roles' => config('constants.roles'),
        ]);
    }

    public function store(UserRequest $request)
    {
        User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'role' => $request->role,
            'is_on' => (bool) $request->is_on,
            'purchaser' => (bool) $request->purchaser,
            'password' => Hash::make($request->password),
        ]);

        return to_route('admin.users.index')->with('success', 'User created');
    }

    public function edit(User $user)
    {
        return Inertia::render('Users/Profile', [
            'user' => $user,
            'roles' => config('constants.roles'),
        ]);
    }

    public function update(UserRequest $request, User $user)
    {
        app(UserService::class)->update($user, $request);

        return back()->with('success', 'User saved');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return back()->with('success', 'User deleted');
    }
}
