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
    Schema::create('ranches', function (Blueprint $table) {
      $table->id();
      $table->string('name')->index();
      $table->string('state')->nullable();
      $table->string('lga')->nullable();
      $table->string('owner_name')->nullable();
      $table->string('phone')->nullable();
      $table->integer('capacity')->nullable();
      $table->decimal('latitude', 10, 7);
      $table->decimal('longitude', 10, 7);
      $table->string('status')->default('active');
      $table->json('metadata')->nullable();
      $table->timestamps();

      $table->unique(['name', 'latitude', 'longitude']);
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('ranches');
  }
};
