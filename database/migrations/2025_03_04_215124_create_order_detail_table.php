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
            $table->tinyInteger('nomor_urut')->unsigned()->default(0)->comment("nomor urut registrasi peserta setiap event");
            $table->decimal('subtotal', 15, 0)->default(0)->comment("subtotal = harga tiket + nomor urut peserta");
            $table->date('racepack_at')->nullable();
            $table->string('racepack_by', 255)->nullable();
            $table->tinyInteger('status')->unsigned()->default(1)->comment("1: aktif; 0: cancel/delete/reject");
            $table->dateTime('insert_at')->useCurrent();
            $table->dateTime('update_at')->nullable()->useCurrentOnUpdate();
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
