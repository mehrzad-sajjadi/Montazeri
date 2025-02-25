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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("user_id");
            $table->foreign("user_id")->references("id")->on("users")->onDelete("cascade");
            $table->unsignedBigInteger("teacher_id");
            $table->foreign("teacher_id")->references("id")->on("users")->onDelete("cascade");

            $table->string("company");
            $table->string("position");
            
            $table->timestamp("start_date");
            $table->string("address");
            $table->string("boss_name");
            $table->string("phone");
            
            $table->boolean("saturday")->default(0);
            $table->boolean("sunday")->default(0);
            $table->boolean("monday")->default(0);
            $table->boolean("tuesday")->default(0);
            $table->boolean("wednesday")->default(0);
            $table->boolean("thursday")->default(0);


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
