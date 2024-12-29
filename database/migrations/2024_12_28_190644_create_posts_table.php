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
            $table->foreignId('user_created')->constrained('users')->onDelete('cascade'); // Foreign key referencing 'users'
            $table->foreignId('page_id')->constrained('pages')->onDelete('cascade'); // Foreign key referencing 'pages'
            $table->string('title'); // Title of the post
            $table->text('content')->nullable(); // Content of the post (nullable)
            $table->string('post_image')->nullable(); // Path or URL of the post image (nullable)
            $table->boolean('job_post')->default(false); // Boolean field indicating if it's a job post
            $table->timestamps(); // created_at and updated_at columns
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
