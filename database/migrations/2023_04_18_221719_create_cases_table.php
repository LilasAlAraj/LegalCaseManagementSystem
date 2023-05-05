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
            $table->date('case_Date');
            $table->string('judge');
            $table->string('enemyLawyer_name');
            $table->integer('enemy_lawyer_phone');
            $table->string('enemyClient_name');
            $table->integer('enemyClient_phone');
            $table->string('side_judge'); //مساعد القاضي 
            $table->string('case_room');
            // $table->unsignedBigInteger('court_id')->nullable();
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
