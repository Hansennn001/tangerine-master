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
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId("member_id");
            $table->foreignId("member_plan_id");
            $table->foreignId("room_id");
            $table->foreignId("course_id");
            $table->foreignId("course_detail_id");
            $table->foreignId("trainer_id")->nullable();
            $table->integer("capacity")->nullable();
            $table->date("date");
            $table->time("time");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};
