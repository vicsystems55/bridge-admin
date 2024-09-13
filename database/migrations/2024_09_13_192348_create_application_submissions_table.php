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
        Schema::create('application_submissions', function (Blueprint $table) {
            $table->id();
            $table->foreign('job_seeker_id')->references('id')->on('users');
            $table->foreignId('job_posting_id');
            $table->string('status')->default('active');



            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('application_submissions');
    }
};
