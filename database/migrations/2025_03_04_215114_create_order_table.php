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
        Schema::create('order', function (Blueprint $table) {
            $table->id();
            $table->string('nomor')->comment('ORD/YYMMDD/0001');
            $table->string('email')->nullable();
            $table->unsignedBigInteger('id_event');
            $table->date('tanggal_bayar')->comment('harus diisi admin jika status lunas ketika approval')->nullable();
            $table->unsignedInteger('jumlah')->default(0)->comment("jumlah tiket");
            $table->decimal('total', 15, 0)->default(0)->comment("total harga tiket");
            $table->tinyInteger('status')->unsigned()->default(1)->comment("1: pending; 2: terbayarkan; 0: cancel/hapus/reject");
            
            $table->dateTime('approve_at')->nullable();
            $table->unsignedBigInteger('approve_by')->nullable();
            $table->dateTime('insert_at')->useCurrent();
            $table->dateTime('update_at')->nullable()->useCurrentOnUpdate();
            $table->unsignedBigInteger('update_by')->nullable();

            // Relations
            $table->foreign('id_event')->references('id')->on('event')->onDelete('cascade');

            // Indexes
            $table->index('nomor');
            $table->index('id_event');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order');
    }
};
