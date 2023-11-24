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
        Schema::create('condition_sensor', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('condition_id');
            $table->unsignedInteger('sensor_port_id');
            $table->string('sensor_port_name');
            $table->float('threshould');
            $table->integer('view_no');
            $table->tinyInteger('condition');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('condition_sensor');
    }
};
