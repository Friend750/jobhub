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
        Schema::create('courses_with_user', function (Blueprint $table) {
            $table->id(); // Primary key (ID)
            $table->foreignId('course_id')->constrained('courses')->onDelete('cascade'); // Foreign key referencing 'courses'
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Foreign key referencing 'users'
            $table->timestamps(); // created_at and updated_at columns
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses_with_user');
    }
};
