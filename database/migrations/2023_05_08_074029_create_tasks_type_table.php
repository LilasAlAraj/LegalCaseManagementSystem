<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('tasks_type', function (Blueprint $table) {
            $table->id('type_id');
            $table->string('task_type_name',50);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tasks_type');
    }
};
