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
        Schema::create('employment_histories_with_user', function (Blueprint $table) {
            $table->id(); // Primary key (ID)
            $table->foreignId('employment_history_id')->references('id')->on('employment_histories');
            $table->foreignId('user_id')->references('id')->on('users');
            $table->timestamps(); // created_at and updated_at columns
            $table->softDeletes(); // Adds the 'deleted_at' column
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employment_histories_with_user');
    }
};
