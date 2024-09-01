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
        Schema::create('professional_references', function (Blueprint $table) {
            $table->id();

            $table->foreignId('profile_update_id');
            $table->foreignId('user_id');

            $table->string('name');
            $table->string('position');
            $table->string('phone');

            $table->boolean('active')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('professional_references');
    }
};