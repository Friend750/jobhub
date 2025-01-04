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

            
            $table->foreignId('conversation_id')->references('id')->on('conversations');
            $table->foreignId('receiver_id')->references('id')->on('users');
            $table->foreignId('sender_id')->references('id')->on('users');


            $table->text('message'); // Chat message content
            //$table->foreignId('')->constrained('users')->onDelete('cascade'); // Foreign key referencing users table
            $table->softDeletes(); // Adds the 'deleted_at' column
            $table->timestamps(); // created_at and updated_at columns
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
