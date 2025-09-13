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
            $table->text('appliance_name');
            $table->set('appliance_type', ['Switch', 'Dimmer']);
            $table->text('appliance_logo')->nullable();

            $table->bigInteger('machine_id')->index()->default(0);
            $table->bigInteger('serial_no')->index()->default(0);
            $table->integer('port')->default(0);

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
