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
        Schema::create('enemy_lawyer_of_cases', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('enemy_lawyer_id')->nullable();
            $table->foreign('enemy_lawyer_id')->references('id')->on('enemy_lawyer');
            $table->unsignedBigInteger('case_id')->nullable();
            $table->foreign('case_id')->references('id')->on('cases');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enemy_lawyer_of_cases');
    }
};
