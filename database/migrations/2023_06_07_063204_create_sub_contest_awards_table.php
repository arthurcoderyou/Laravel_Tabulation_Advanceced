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
        Schema::create('sub_contest_awards', function (Blueprint $table) {
            $table->id();
            $table->longText('award_name');
            $table->foreignId('sub_contest_id');
            $table->foreign('sub_contest_id')->references('id')->on('sub_contests')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('contestant_id');
            $table->foreign('contestant_id')->references('id')->on('contestants')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_contest_awards');
    }
};
