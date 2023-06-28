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
        Schema::create('sub_contests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('contest_id');
            $table->foreign('contest_id')->references('id')->on('contests')->onUpdate('cascade')->onDelete('cascade');
            $table->longText('subcontest_name');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_contests');
    }
};
