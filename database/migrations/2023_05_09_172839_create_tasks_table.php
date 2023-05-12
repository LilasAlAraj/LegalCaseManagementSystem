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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('type_id');
            $table->string('task_name',50);
            $table->text('description');
            $table->date('start_date');
            $table->date('end_date');
            $table->text('status');
            $table->integer('status_value')->default(0);//to_do
            $table->string('user_first_name');//name of the owner of task 
            $table->string('user_last_name');
            $table->string('case_number');//رقم الاساس
            $table->foreign('type_id')->references('type_id')->on('tasks_type')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
