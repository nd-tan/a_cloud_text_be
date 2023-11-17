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
        Schema::create('accress_right', function (Blueprint $table) {
            $table->id();
            $table->foreignId('contractor_id')->references('id')->on('contractors');
            $table->string('remark')->nullable();
            $table->string('name');
            $table->integer('access_rights');
            $table->integer('dashboard');
            $table->integer('data');
            $table->integer('data_export');
            $table->integer('device');
            $table->integer('alert');
            $table->integer('alert_mail');
            $table->integer('sensor');
            $table->integer('account');
            $table->integer('groups');
            $table->integer('test');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accress_right');
    }
};
