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
        Schema::create('receive_data', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('device_id');
            $table->string('device_name');
            $table->unsignedInteger('contractor_id');
            $table->unsignedInteger('group_id')->nullable();
            $table->string('group_name')->nullable();
            $table->dateTime('tm');
            $table->double('d1_raw')->nullable();
            $table->double('d2_raw')->nullable();
            $table->double('d3_raw')->nullable();
            $table->double('d4_raw')->nullable();
            $table->double('d5_raw')->nullable();
            $table->double('d6_raw')->nullable();
            $table->double('d7_raw')->nullable();
            $table->double('d8_raw')->nullable();
            $table->double('d1_calc')->nullable();
            $table->double('d2_calc')->nullable();
            $table->double('d3_calc')->nullable();
            $table->double('d4_calc')->nullable();
            $table->double('d5_calc')->nullable();
            $table->double('d6_calc')->nullable();
            $table->double('d7_calc')->nullable();
            $table->double('d8_calc')->nullable();
            $table->double('a1_raw')->nullable();
            $table->double('a2_raw')->nullable();
            $table->double('a3_raw')->nullable();
            $table->double('a4_raw')->nullable();
            $table->double('a5_raw')->nullable();
            $table->double('a6_raw')->nullable();
            $table->double('a7_raw')->nullable();
            $table->double('a8_raw')->nullable();
            $table->double('a1_calc')->nullable();
            $table->double('a2_calc')->nullable();
            $table->double('a3_calc')->nullable();
            $table->double('a4_calc')->nullable();
            $table->double('a5_calc')->nullable();
            $table->double('a6_calc')->nullable();
            $table->double('a7_calc')->nullable();
            $table->double('a8_calc')->nullable();
            $table->integer('adgp')->nullable();
            $table->double('eitemp')->nullable();
            $table->double('eihumi')->nullable();
            $table->double('eilprs')->nullable();
            $table->double('seaprs')->nullable();
            $table->string('beacon')->nullable();
            $table->string('msg')->nullable();
            $table->integer('rping')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('receive_data');
    }
};
