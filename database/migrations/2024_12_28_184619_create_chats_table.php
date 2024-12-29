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
        Schema::create('chats', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key
            $table->text('message'); // Chat message content
            $table->timestamps(); // created_at and updated_at columns
            $table->foreignId('sender_id')->constrained('users')->onDelete('cascade'); // Foreign key referencing users table
            $table->foreignId('receiver_id')->constrained('users')->onDelete('cascade'); // Foreign key referencing users table
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chats');
    }
};
