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
        Schema::create('personal_details', function (Blueprint $table) {
            $table->id(); // Primary key (ID)
            $table->string('first_name'); // First name of the person
            $table->string('last_name'); // Last name of the person
            $table->string('specialist')->nullable(); // Job title (nullable)

            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
            
            // $table->string('email')->unique(); // Email address (unique)
            $table->string('phone')->nullable(); // Phone number (nullable)
            $table->string('city')->nullable(); // City (nullable)
            $table->timestamps(); // created_at and updated_at columns
            $table->softDeletes(); // Adds the 'deleted_at' column
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personal_details');
    }
};
