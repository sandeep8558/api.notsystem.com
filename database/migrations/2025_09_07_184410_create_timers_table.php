<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('timers', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('appliance_id')->index();
            $table->set('timer_type', ['daily','days','dates']);
            $table->text('days')->nullable();
            $table->date('from_date')->nullable();
            $table->date('to_date')->nullable();
            $table->time('from_time');
            $table->time('to_time');
            $table->boolean('is_timer_off')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('timers');
    }
};
