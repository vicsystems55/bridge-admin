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
        Schema::create('y_g_submissions', function (Blueprint $table) {
            $table->id();
            $table->integer('score')->default(0); // Score, default 0
            $table->foreignId('user_id')->nullable();
            $table->string('full_name');
            $table->string('email');
            $table->string('phone');
            $table->string('address');
            $table->string('facebook')->nullable(); // Allow null for optional fields
            $table->string('instagram')->nullable();
            $table->string('tiktok')->nullable();
            $table->string('twitter')->nullable();
            $table->string('other')->nullable();
            $table->string('file_path')->nullable(); // Store the path to the uploaded file
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('y_g_submissions');
    }
};
