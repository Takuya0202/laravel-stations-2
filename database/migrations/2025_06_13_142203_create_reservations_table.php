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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->date('date')->comment('上映日');
            $table->unsignedBigInteger('schedule_id')->index();
            $table->foreign('schedule_id')->references('id')->on('schedules')->onDelete('cascade');
            $table->unsignedBigInteger('sheet_id')->index();
            $table->foreign('sheet_id')->references('id')->on('sheets')->onDelete('cascade');
            $table->string('email',255);
            $table->string('name',255);
            $table->boolean('is_canceled')->default(false);
            $table->unique(['schedule_id','sheet_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
