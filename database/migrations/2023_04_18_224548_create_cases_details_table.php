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
        Schema::create('cases_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_Cases');
            $table->string('case_number', 50);
            $table->string('Status', 50);
            $table->string('decision', 50);
            $table->text('facts')->nullable();
            $table->text('legal_discussion')->nullable();
            $table->text('verdict')->nullable();
            $table->foreign('id_cases')->references('id')->on('cases')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cases_details');
    }
};
