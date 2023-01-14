<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ConciergeRequest;
use App\Models\Concierge;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ConciergeController extends Controller
{
    public function index(Request $request)
    {
        $concierges = Concierge::when(request('search'), function ($query, $search) {
            $query
                    ->where('name', 'like', '%' . $search . '%')
                    ->orWhere('initials', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%');
        })
            ->paginate(15)
            ->withQueryString();

        return Inertia::render('Concierges/Index', [
            'concierges' => $concierges,
            'filters' => $request->only('search'),
        ]);
    }

    public function store(ConciergeRequest $request)
    {
        try {
            Concierge::create($request->validated());

            return redirect()->back()->with('success', 'Created');
        } catch (\Throwable $th) {
            \Log::error($th);

            return redirect()->back()->with('error', 'Not created');
        }
    }

    public function update(ConciergeRequest $request, Concierge $concierge)
    {
        try {
            $concierge->update($request->validated());

            return redirect()->back()->with('success', 'Updated');
        } catch (\Throwable $th) {
            \Log::error($th);

            return redirect()->back()->with('error', 'Not updated');
        }
    }

    public function destroy(Concierge $concierge)
    {
        try {
            $concierge->delete();
            return back()->with('success', 'Deleted');
        } catch (\Throwable $th) {
            \Log::error($th);
            return back()->with('error', 'Not deleted');
        }
    }
}
