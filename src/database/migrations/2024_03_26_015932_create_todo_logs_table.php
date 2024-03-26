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
        Schema::create('todo_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('todo_id')->nullable()->constrained('todos')->nullOnDelete();
            $table->text('content');
            $table->timestamp('scheduled_at');
            $table->timestamp('expired_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('todo_logs');
    }
};
