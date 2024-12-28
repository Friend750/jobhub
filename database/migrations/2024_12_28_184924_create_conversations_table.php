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
        Schema::create('conversations', function (Blueprint $table) {
            $table->id(); // Primary key (ID)
            $table->foreignId('first_chat')->constrained('users')->onDelete('cascade'); // Foreign key referencing 'users'
            $table->foreignId('second_chat')->constrained('users')->onDelete('cascade'); // Foreign key referencing 'users'
            $table->text('last_message')->nullable(); // Last message content
            $table->timestamps(); // created_at and updated_at columns
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('conversations');
    }
};
