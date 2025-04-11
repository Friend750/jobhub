<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('comments', function (Blueprint $table) {
            $table->dropForeign(['post_id']);
            $table->renameColumn('post_id', 'commentable_id');
            $table->string('commentable_type'); // This will store the model class (e.g., 'App\Models\Post')
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
    }
};
