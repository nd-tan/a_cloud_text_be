<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('contractors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('postal_code')->nullable();
            $table->string('address')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('person')->nullable();
            $table->date('start_date');
            $table->date('end_date');
            $table->string('remark')->nullable();
            $table->integer('is_system')->default(0);
            $table->integer('state')->default(0);
            $table->timestamps();
        });
        DB::statement("ALTER TABLE `contractors`
                        ADD COLUMN `logo` mediumblob NULL AFTER `person`
                    ;");

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contractors');
    }
};
