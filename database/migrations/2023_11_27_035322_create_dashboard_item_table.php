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
        Schema::create('dashboard_item', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('dashboard_id');
            $table->unsignedBigInteger('device_id');
            $table->unsignedBigInteger('sensor_port_id');
            $table->unsignedBigInteger('sensor_port_id2');
            $table->string('title');
            $table->string('title2');
            $table->integer('position');
            $table->integer('position2');
            $table->integer('chart_time');
            $table->integer('alert_number');
            $table->double('gauge_min');
            $table->double('gauge_max');
            $table->integer('warning_time');
            $table->integer('caution_time');
            $table->integer('day_number');
            $table->timeTz('machine_start_time');
            $table->timeTz('machine_end_time');
            $table->double('gauge1_min');
            $table->double('gauge1_max');
            $table->integer('gauge1_color');
            $table->double('gauge2_min');
            $table->double('gauge2_max');
            $table->integer('gauge2_color');
            $table->double('gauge3_min');
            $table->double('gauge3_max');
            $table->integer('gauge3_color');
            $table->string('gauge_hide_label');
            $table->integer('grids');
            $table->integer('show_gauge');
            $table->unsignedBigInteger('image_id');
            $table->unsignedBigInteger('comment_id');
            $table->integer('type');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dashboard_item');
    }
};
