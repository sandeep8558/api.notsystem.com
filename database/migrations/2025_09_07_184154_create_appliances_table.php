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
        Schema::create('appliances', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('user_id')->index();
            $table->bigInteger('place_id')->index();
            $table->bigInteger('room_id')->index();
            $table->bigInteger('machine_id')->index();
            $table->bigInteger('serial_no')->index();
            $table->text('appliance_name');
            $table->text('appliance_logo');
            $table->text('port');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appliances');
    }
};
