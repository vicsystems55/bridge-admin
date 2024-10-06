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
        Schema::create('company_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('company_name');
            $table->string('industry_type');
            $table->string('about');
            $table->string('address');
            $table->string('company_size');
            $table->string('company_logo')->nullable();
            $table->string('website')->nullable();
            $table->string('facebook_url')->nullable();
            $table->string('twitter_url')->nullable();
            $table->string('instagram_url')->nullable();
            $table->string('linkedIn_url')->nullable();
            $table->string('otherlinks_1')->nullable();
            $table->string('otherlinks_2')->nullable();
            $table->string('otherlinks_3')->nullable();
            $table->string('otherlinks_4')->nullable();
            $table->string('status')->default('active');



            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_profiles');
    }
};
