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
        Schema::create('groups', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('group_id')->unique()->nullable();
            $table->integer('contractor_id');
            $table->string('name', 255);
            $table->text('path');
            $table->text('info_board')->nullable();
            $table->double('latitude')->nullable();
            $table->double('longitude')->nullable();
            $table->string('group_week')->nullable();
            $table->timeTz('group_start_time')->nullable();
            $table->timeTz('group_end_time')->nullable();
            $table->timeTz('break_start_time1')->nullable();
            $table->timeTz('break_end_time1')->nullable();
            $table->timeTz('break_start_time2')->nullable();
            $table->timeTz('break_end_time2')->nullable();
            $table->timeTz('break_start_time3')->nullable();
            $table->timeTz('break_end_time3')->nullable();
            $table->string('remark')->nullable();
            $table->timestamps();
            $table->integer('updated_ID')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('groups');
    }
};
