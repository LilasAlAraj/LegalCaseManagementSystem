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
        Schema::create('enemy_client_of_cases', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('enemy_client_id');
            $table->foreign('enemy_client_id')->references('id')->on('enemy_client');
            $table->unsignedBigInteger('case_id');
            $table->foreign('case_id')->references('id')->on('cases');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enemy_client_of_cases');
    }
};
