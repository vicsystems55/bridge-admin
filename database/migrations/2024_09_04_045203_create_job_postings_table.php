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
        Schema::create('job_postings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('job_title');
            $table->foreignId('company_profile_id')->nullable();
            $table->longText('job_description');
            $table->string('employment_type');
            $table->string('deadline');
            $table->string('min_qualification')->nullable();
            $table->string('min_experience')->nullable();
            $table->string('renumeration_type')->nullable();
            $table->string('renumeration_amount')->nullable();

            $table->string('company_name')->nullable();
            $table->string('company_industry')->nullable();
            $table->string('website')->nullable();
            $table->string('location')->nullable();
            $table->boolean('active')->default(1);












            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_postings');
    }
};
