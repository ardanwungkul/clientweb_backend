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
        Schema::create('name_servers', function (Blueprint $table) {
            $table->id();
            $table->string('nameserver1');
            $table->string('nameserver2');
            $table->date('tanggal_ns');
            $table->string('status_ns');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('name_servers');
    }
};
