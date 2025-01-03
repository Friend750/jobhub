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

            $table->foreignId('user_id')->references('id')->on('users');


            $table->string('institution_name'); 
            $table->string('certification_name');
            $table->string('location');
            $table->string('degree'); // Education title
            $table->text('description')->nullable(); // Description of the education (nullable)
            $table->date('graduation_date')->nullable(); // Start date of the education
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
