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
        Schema::create('todos', function (Blueprint $table) {
            $table->id();
            $table->string('subject');
            $table->text('catatan');
            $table->enum('status', ['todo', 'doing', 'done', 'deleted'])->default('todo');
            $table->dateTime('done_at')->nullable();
            $table->boolean('isConfirm')->default(false);
            $table->string('point')->default(1);
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('todo_from')->nullable();
            $table->foreign('todo_from')->references('id')->on('users')->onDelete('cascade');
            $table->string('lampiran')->nullable();
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('todos');
    }
};
