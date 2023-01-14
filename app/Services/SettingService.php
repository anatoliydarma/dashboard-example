<?php
namespace App\Services;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Settings\StatueSettings;
use App\Models\User;

class SettingService
{
    public function get(String $settings, $key = null)
    {
        if ($key === null) {
            return collect(app(StatueSettings::class)->$settings)->toArray();
        } else {
            return collect(app(StatueSettings::class)->$settings)->where('key', $key)->first();
        }
    }
}
