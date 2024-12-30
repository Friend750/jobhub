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
        Schema::create('interactions', function (Blueprint $table) {
            $table->id(); // Primary key (ID)
            $table->foreignId('user_id')->references('id')->on('users');
            $table->foreignId('post_id')->references('id')->on('posts');
            $table->enum('type', ['comment', 'like', 'share']); // Interaction type (comment, like, share)
            $table->text('comment')->nullable(); // Comment content (optional)
            $table->timestamps(); // created_at and updated_at columns
            $table->softDeletes(); // Adds the 'deleted_at' column
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('interactions');
    }
};
