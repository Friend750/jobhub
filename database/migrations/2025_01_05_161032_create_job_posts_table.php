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
        Schema::create('job_posts', function (Blueprint $table) {
            $table->id(); // Primary key

            $table->foreignId('user_id')->references('id')->on('users');


            $table->string('job_title');
            $table->text('about_job');
            $table->text('job_tasks');
            $table->text('job_conditions')->nullable();
            $table->text('job_skills')->nullable();
            $table->string('job_location');
            $table->string('job_timing');
            $table->json('tags');
            $table->enum('target', ['to_any_one', 'connection_only']);
            $table->boolean('is_active',true);
            $table->timestamps(); // created_at و updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_posts');
    }
};
