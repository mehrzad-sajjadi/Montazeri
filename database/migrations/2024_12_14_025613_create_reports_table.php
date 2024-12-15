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
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->string("text");
            $table->string("image")->nullable();
            $table->timestamp("date");

            $table->time("start_time");
            $table->time("end_time");

            $table->unsignedBigInteger("student_id");
            $table->foreign("student_id")->references("id")->on("students")->onDelete("cascade");
            $table->timestamps();                   
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
