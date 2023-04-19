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
        Schema::create('userssystem', function (Blueprint $table) {
            $table->id();
            $table->string('Password');
            $table->string('First_Name');
            $table->string('Middle_Name');
            $table->string('Last_Name');
            $table->string('Email')->unique();
            $table->timestamp('Email_verified_at')->nullable();
            $table->string('Location');
            $table->integer('Phone_Number');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('userssystem');
    }
};
