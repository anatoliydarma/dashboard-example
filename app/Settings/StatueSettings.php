<?php
namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class StatueSettings extends Settings
{
    public array $products = [];
    public array $product_options = [];

    public static function group(): string
    {
        return 'statue';
    }
}
