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
            $table->dateTime('racepack_at')->nullable();
            $table->unsignedBigInteger('racepack_by')->nullable();
            $table->timestamp('insert_at', 3)->useCurrent();
            $table->timestamp('update_at', 3)->nullable()->useCurrentOnUpdate();
            $table->unsignedBigInteger('update_by')->nullable()->useCurrentOnUpdate();
            
            $table->foreign('nomor_order')->references('nomor')->on('order')->onDelete('cascade');
            
            $table->index('nomor_order', 'order_detail_nomor_order_index');
            $table->index('id_peserta', 'order_detail_id_peserta_index');
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
