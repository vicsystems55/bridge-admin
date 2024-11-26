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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Project title
            $table->text('description'); // Project description
            $table->decimal('min_budget', 10, 2); // Minimum budget for the project
            $table->decimal('max_budget', 10, 2); // Maximum budget for the project
            $table->string('category'); // Category of the project (e.g., tech, fashion)
            $table->json('skills');
            $table->string('status')->default('active');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
