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
        Schema::create('courses', function (Blueprint $table) {
            $table->id(); // Primary key (ID)
            $table->string('course_name'); // Name of the course
            $table->string('institution'); // Institution offering the course
            $table->date('start_date')->nullable(); // Start date of the course
            $table->date('end_date')->nullable(); // End date of the course
            $table->timestamps(); // created_at and updated_at columns
            $table->softDeletes(); // Adds the 'deleted_at' column
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
