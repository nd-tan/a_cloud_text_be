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
        Schema::create('devices', function (Blueprint $table) {
            $table->id();
            $table->string('device_string');
            $table->unsignedBigInteger('contractor_id');
            $table->unsignedBigInteger('group_id');
            $table->unsignedBigInteger('product_id');
            $table->string('name');
            $table->tinyInteger('state')->default(0);
            $table->tinyInteger('is_exit')->default(0);
            $table->tinyInteger('is_virtual')->default(0);
            $table->string('publish_topic')->nullable();
            $table->string('subscribe_topic')->nullable();
            $table->string('email_week');
            $table->dateTime('email_start_time');
            $table->dateTime('email_end_time');
            $table->integer('email_resent_time')->default(60);
            $table->dateTime('state_time');
            $table->tinyInteger('truble_sending')->default(0);
            $table->string('machine_week');
            $table->dateTime('machine_start_time');
            $table->dateTime('machine_end_time');
            $table->tinyInteger('show_sum_time1')->default(1);
            $table->tinyInteger('show_sum_time2')->default(1);
            $table->dateTime('break_start_time1');
            $table->dateTime('break_end_time1');
            $table->dateTime('break_start_time2');
            $table->dateTime('break_end_time2');
            $table->dateTime('break_start_time3');
            $table->dateTime('break_end_time3');
            $table->string('remark');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('devices');
    }
};
