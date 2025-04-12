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
        Schema::create('komunitas', function (Blueprint $table) {
            $table->id(); // Auto-increment BIGINT PRIMARY KEY
            $table->string('nama', 255);
            $table->string('koordinator', 255);
            $table->string('email', 100);
            $table->string('kota', 20);
            $table->string('phone', 20);
            $table->tinyInteger('status')->unsigned()->default(1)->comment('1: aktif; 0: non-aktif');
            $table->dateTime('insert_at')->useCurrent();
            $table->dateTime('update_at')->nullable()->useCurrentOnUpdate();
            $table->unsignedBigInteger('update_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('komunitas');
    }
};
