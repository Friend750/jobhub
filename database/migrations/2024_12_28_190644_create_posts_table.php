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


            $table->foreignId('user_created')->references('id')->on('users');
            $table->foreignId('page_id')->references('id')->on('pages');


            $table->enum('target', ['to_any_one', 'connection_only']);
            $table->string('title'); // Title of the post
            $table->text('content')->nullable(); // Content of the post (nullable)
            $table->string('post_image')->nullable(); // Path or URL of the post image (nullable)
            $table->boolean('job_post')->default(false); // Boolean field indicating if it's a job post
            $table->json('tags')->nullable();
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
