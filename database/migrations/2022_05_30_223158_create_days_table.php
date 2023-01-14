<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDaysTable extends Migration
{
    public function up()
    {
        Schema::create('days', function (Blueprint $table) {
            $table->id();
            $table->date('date')->index();

            $table->time('time_a')->nullable();
            $table->integer('reserved_a')->default(0);
            $table->string('confirm_a')->nullable();

            $table->time('time_b', $precision = 0)->nullable();
            $table->integer('reserved_b')->default(0);
            $table->string('confirm_b')->nullable();

            $table->time('time_c', $precision = 0)->nullable();
            $table->integer('reserved_c')->default(0);
            $table->string('confirm_c')->nullable();

            $table->string('note')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('days');
    }
}
