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
            $table->integer('case_number');
            $table->date('case_Date');
            $table->string('judge');
            $table->string('side_judge');  //مساعد القاضي 
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
