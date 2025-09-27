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
        Schema::create('notifications', function (Blueprint $table) {
    $table->uuid('id')->primary();
    $table->string('type')->index(); // للاستعلام حسب النوع
    $table->morphs('notifiable');    // ينشئ index على (notifiable_type, notifiable_id)
    $table->text('data');
    $table->timestamp('read_at')->nullable()->index();
    $table->timestamps();

    // فهرس مركب للاستعلامات الشائعة
    $table->index(['notifiable_id', 'type', 'read_at']);
    $table->index(['notifiable_id', 'type', 'created_at']);
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
