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
        Schema::create('machines', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('user_id')->index();
            $table->bigInteger('place_id')->index();
            $table->bigInteger('room_id')->index();
            $table->bigInteger('serial_no')->index();
            $table->ipAddress('ip_address');
            $table->text('ports');
            $table->text('state');
            $table->timestamp('ts');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('machines');
    }
};
