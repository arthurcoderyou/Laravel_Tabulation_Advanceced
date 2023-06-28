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
        Schema::create('sub_criteria_judgments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('criteria_id');
            $table->foreign('criteria_id')->references('id')->on('criterias')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('judge_id');
            $table->foreign('judge_id')->references('id')->on('judges')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('contestant_id');
            $table->foreign('contestant_id')->references('id')->on('contestants')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('contestant_score');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_criteria_judgments');
    }
};
