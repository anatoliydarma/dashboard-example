<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

class CreateStatueSettings extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('statue.products', []);
        $this->migrator->add('statue.product_options', []);
    }

    public function down(): void
    {
        $this->migrator->remove('statue.products');
        $this->migrator->remove('statue.product_options');
    }
}
