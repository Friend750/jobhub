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
            $table->string('page_name')->nullable(); // Avatar image (nullable)
            $table->string('first_name')->nullable(); // First name of the person
            $table->string('last_name')->nullable(); // Last name of the person
            $table->string('specialist')->nullable(); // Job title (nullable)
            $table->text('professional_summary')->nullable();
            $table->string('phone')->nullable(); // Phone number (nullable)
            $table->string('city')->nullable(); // City (nullable)
            $table->string('website_name')->nullable(); // Name of the website
            $table->string('link')->nullable(); // URL link (unique)

            $table->timestamps();
            $table->softDeletes();

            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
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
