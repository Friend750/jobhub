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
        Schema::create('employment_histories', function (Blueprint $table) {
            $table->id(); // Primary key (ID)
            $table->string('job_title'); // Job title
            $table->string('employer'); // Employer's name
            $table->date('start_date')->nullable(); // Start date of employment
            $table->date('end_date')->nullable(); // End date of employment
            $table->text('describe')->nullable(); // Description of the employment role
            $table->timestamps(); // created_at and updated_at columns
            $table->softDeletes(); // Adds the 'deleted_at' column
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employment_histories');
    }
};
