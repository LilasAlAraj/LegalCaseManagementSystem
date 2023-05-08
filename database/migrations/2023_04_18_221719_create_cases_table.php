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
            $table->string('title');
            $table->string('Status', 50);   //حالة القضية
            $table->integer('Value_Status'); // رقم الحالة من اجل المقارنة 
            $table->integer('case_number');
            $table->date('case_Date')->nullable();
            $table->string('judge')->nullable();
            $table->string('enemy_Lawyer_name');
            $table->integer('enemy_Lawyer_phone');
            $table->string('enemy_Client_name');
            $table->integer('enemy_Client_phone');
            $table->string('side_judge')->nullable(); //مساعد القاضي 
            $table->string('case_room');
            // $table->bigInteger('court_id');
            // $table->foreign('court_id')->references('id')->on('court')->onDelete('cascade');
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
