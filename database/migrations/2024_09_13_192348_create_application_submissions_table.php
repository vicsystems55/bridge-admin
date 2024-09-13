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

            $table->bigInteger('job_seeker_id')->unsigned();
            $table->bigInteger('reviewed_by')->unsigned();


            $table->foreignId('job_posting_id');

            $table->string('cover_letter')->nullable();
            $table->string('portfolio')->nullable();
            $table->string('uploaded_cv_path')->nullable();

            $table->string('status')->default('active');



            $table->foreign('job_seeker_id')->references('id')->on('users');
            $table->foreign('reviewed_by')->references('id')->on('users');



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
