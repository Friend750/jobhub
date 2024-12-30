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
        Schema::create('personal_details_with_user', function (Blueprint $table) {
            $table->id(); // Primary key (ID)
            $table->foreignId('user_id')->references('id')->on('users');
            $table->foreignId('personal_detail_id')->references('id')->on('personal_details');
            $table->timestamps(); // created_at and updated_at columns
            $table->softDeletes(); // Adds the 'deleted_at' column
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personal_details_with_user');
    }
};
