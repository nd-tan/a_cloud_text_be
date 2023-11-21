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
        Schema::create('sensors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('contractor_id')->nullable()->constrained('contractors')->onUpdate('cascade')->onDelete('set null');
            $table->string('name');
            $table->string('maker')->nullable();
            $table->string('model_number')->nullable();
            $table->integer('interface');
            $table->string('calc')->nullable();
            $table->string('unit')->nullable();
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
        Schema::dropIfExists('sensors');
    }
};
