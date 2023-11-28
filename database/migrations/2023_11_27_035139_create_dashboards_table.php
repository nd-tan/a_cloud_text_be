<?php

use App\Models\User;
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
        Schema::create('dashboards', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('contractor_id');
            $table->unsignedBigInteger('group_id');
            $table->unsignedBigInteger('user_id');
            $table->integer('position');
            $table->string('title');
            $table->integer('type');
            $table->integer('is_groups');
            $table->unsignedBigInteger('owner_group_id');
            $table->unsignedBigInteger('device_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::enableForeignKeyConstraints();
    }
};
