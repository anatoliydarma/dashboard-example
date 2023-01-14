<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Settings\StatueSettings;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Inertia\Inertia;

class SettingController extends Controller
{
    public function index(StatueSettings $settings)
    {
        return Inertia::render('Settings/Index', [
            'products' => [
                'data' => array_values($settings->products),
            ],
            'product_options' => [
                'data' => array_values($settings->product_options),
            ],
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return RedirectResponse
     */
    public function store(Request $request, StatueSettings $settings)
    {
        $group = $request->input('group');
        $item = $request->input('item');

        if ($item !== null) {
            $settings->{$group} = [
                ...$settings->{$group},
                $item,
            ];

            $settings->save();

            return redirect()->back()->with('success', 'Saved');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, StatueSettings $settings): RedirectResponse
    {
        $group = $request->input('group');
        $key = $request->input('key');
        $item = $request->input('item');

        $settings->{$group} = collect($settings->{$group})->map(function ($record) use ($key, $item) {
            return $key === $record['key'] ? $item : $record;
        })->filter()->toArray();

        $settings->save();

        return redirect()->back()->with('success', 'Saved');
    }

    /**
     *  Remove the specified resource from storage.
     *
     * @return RedirectResponse
     */
    public function destroy(Request $request, StatueSettings $settings)
    {
        $group = $request->input('group');
        $key = $request->input('item')['key'];

        $settings->{$group} = array_filter($settings->{$group}, function ($item) use ($key) {
            return $key !== $item['key'];
        });

        $settings->save();

        return redirect()->back();
    }

    public function cleanCache(Request $request)
    {
        try {
            \Artisan::call('optimize:clear');
            Cache::flush();

            return back()->with('success', 'Laravel cache is cleaned');
        } catch (\Throwable $th) {
            \Log::error($th);

            return back()->with('warning', 'Laravel cache was not cleaned');
        }
    }

    public function getDataFromProd()
    {
        try {
            \Artisan::call('snapshot:create --connection=sync --exclude=users,activity_log,failed_jobs,migrations,password_resets,personal_access_tokens');
            \Artisan::call('snapshot:load --latest --drop-tables=0');
            \Artisan::call('snapshot:cleanup');

            return back()->with('success', 'DB synced');
        } catch (\Throwable $th) {
            \Log::error($th);
            return back()->with('warning', 'DB was not synced');
        }
    }
}
