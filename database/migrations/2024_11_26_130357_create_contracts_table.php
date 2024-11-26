<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContractsTable extends Migration
{
    public function up()
    {
        Schema::create('contracts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('freelancer_id'); // Foreign key for the freelancer
            $table->unsignedBigInteger('recruiter_id'); // Foreign key for the recruiter
            $table->unsignedBigInteger('project_id'); // Foreign key for the project
            $table->decimal('bid_price', 10, 2); // Bid price agreed upon
            $table->integer('duration'); // Duration in days
            $table->text('description'); // Additional details about the contract
            $table->enum('status', ['pending', 'active', 'completed', 'cancelled'])->default('pending'); // Status of the contract
            $table->integer('rating')->nullable(); // Rating given by the recruiter (e.g., 1–5 stars)
            $table->text('review')->nullable(); // Optional text review from the recruiter
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('freelancer_id')
                ->references('id')
                ->on('users') // Assuming freelancers are stored in the 'users' table
                ->onDelete('cascade');

            $table->foreign('recruiter_id')
                ->references('id')
                ->on('users') // Assuming recruiters are stored in the 'users' table
                ->onDelete('cascade');

            $table->foreign('project_id')
                ->references('id')
                ->on('projects') // Ties the contract to a project
                ->onDelete('cascade');
        });


    }

    public function down()
    {


        Schema::dropIfExists('contracts');
    }
}
