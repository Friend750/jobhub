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
    $table->id();
    $table->text('last_message')->nullable();

    $table->foreignId('first_user')
          ->constrained('users')
          ->onDelete('cascade');

    $table->foreignId('second_user')
          ->constrained('users')
          ->onDelete('cascade');

    $table->timestamps();
    $table->softDeletes();

    // منع تكرار نفس المحادثة
    $table->unique(['first_user', 'second_user']);
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
