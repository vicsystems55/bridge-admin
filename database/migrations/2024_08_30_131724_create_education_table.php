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
        Schema::create('education', function (Blueprint $table) {
            $table->id();
            $table->foreignId('profile_update_id')->nullable();
            $table->foreignId('user_id');

            $table->string('award');
            $table->string('institution_name');
            $table->string('location');
            $table->string('graduation_date');
            $table->string('field_of_study');
            $table->boolean('active')->default(0);


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('education');
    }
};
