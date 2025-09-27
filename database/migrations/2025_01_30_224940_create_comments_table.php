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
      Schema::create('comments', function (Blueprint $table) {
    $table->id();

    $table->foreignId('user_id')->constrained()->onDelete('cascade');

    $table->foreignId('commentable_id'); // polymorphic id
    $table->string('commentable_type');  // polymorphic type

    $table->foreignId('parent_id')->nullable()->constrained('comments')->onDelete('cascade');

    $table->text('content');
    $table->timestamps();

    $table->index(['commentable_type', 'commentable_id']); // index لتسريع البحث
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
