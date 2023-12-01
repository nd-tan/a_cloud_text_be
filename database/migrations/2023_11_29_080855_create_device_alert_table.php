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
        Schema::create('device_alert', function (Blueprint $table) {
            $table->id();
            $table->string('name',255);
            $table->bigInteger('device_id');
            $table->bigInteger('sensor_port');
            $table->double('threshold_value');
            $table->double('duration');
            $table->tinyInteger('logic')->unsigned();
            $table->tinyInteger('threshold_condition')->unsigned();
            $table->tinyInteger('judgment_interval_type')->unsigned();
            $table->text('email');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('device_alert');
    }
};
