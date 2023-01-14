<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasColumn('days', 'tc')) {
            Schema::table('days', function (Blueprint $table) {
                $table->dropColumn('tc');
            });
        }

        Schema::table('days', function (Blueprint $table) {
            $table->integer('tc')->nullable();
        });
    }
};
