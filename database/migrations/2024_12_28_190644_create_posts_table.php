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
        Schema::create('posts', function (Blueprint $table) {
            $table->id(); // Primary key (ID)


            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');


            $table->enum('target', ['to_any_one', 'connection_only']);
            $table->text('content')->nullable(); // Content of the post (nullable)
            $table->string('post_image')->nullable(); // Path or URL of the post image (nullable)
            $table->json('tags')->nullable();
            $table->integer('views')->default(0);

            $table->timestamps(); // created_at and updated_at columns
            $table->softDeletes(); // Adds the 'deleted_at' column
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
