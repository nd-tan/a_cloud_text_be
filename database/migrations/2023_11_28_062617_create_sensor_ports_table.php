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
        Schema::create('sensor_ports', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('device_id');
            $table->integer('port_no');
            $table->unsignedBigInteger('sensor_id')->nullable();
            $table->double('plus_offset')->default(1);
            $table->double('minus_offset')->default(1);
            $table->string('alias_name')->nullable();
            $table->integer('not_round');
            $table->integer('show_digits')->default(2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sensor_ports');
    }
};
