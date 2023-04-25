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
        Schema::create('cases', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('cases_number', 50);
            $table->date('case_Date')->nullable();
            $table->date('Due_date')->nullable();
            $table->string('court_Name');
            $table->string('room');
            $table->string('base_Number');
            $table->string('claimant_Name');
            $table->string('defendant_Name');
            $table->string('claimant_Lawyer');
            $table->string('defendant_Lawyer');
            $table->text('cases_Subject')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cases');
    }
};
