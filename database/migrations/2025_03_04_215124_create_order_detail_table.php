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
        Schema::create('order_detail', function (Blueprint $table) {
            $table->id();            
            $table->string('nomor_order');
            $table->unsignedBigInteger('id_peserta');
            $table->string('size', 10)->comment('table: size_chart');

            // Relations
            $table->foreign('nomor_order')->references('nomor')->on('order')->onDelete('cascade');

            // Indexes
            $table->index('nomor_order');
            $table->index('id_peserta');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_detail');
    }
};
