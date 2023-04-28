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
            $table->string('Status', 50);   //حالة القضية
            $table->integer('Value_Status'); // رقم الحالة من اجل المقارنة 
            $table->text('facts')->nullable(); //الحقائق
            $table->text('legal_discussion')->nullable(); //الوقائع والالتماس
            $table->unsignedBigInteger('id_Cases')->nullable(); ;
            $table->foreign('id_cases')->references('id')->on('cases')->onDelete('cascade');
               // $table->string('user_',300); //
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
