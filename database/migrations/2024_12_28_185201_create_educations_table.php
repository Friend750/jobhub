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
        Schema::create('educations', function (Blueprint $table) {
            $table->id(); // Primary key (ID)
            $table->string('title'); // Education title
            $table->text('describe')->nullable(); // Description of the education (nullable)
            $table->date('start_date')->nullable(); // Start date of the education
            $table->date('end_date')->nullable(); // End date of the education
            $table->timestamps(); // created_at and updated_at columns
            $table->softDeletes(); // Adds the 'deleted_at' column
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('educations');
    }
};
