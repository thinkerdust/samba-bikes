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
        Schema::create('event', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->date('tanggal');
            $table->text('deskripsi')->nullable();
            $table->string('lokasi');
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->decimal('harga', 15, 0)->default(0);
            $table->unsignedInteger('stok')->default(0);
            $table->string('nomor_rekening', 20);
            $table->string('nama_rekening');
            $table->string('bank')->comment("table: bank");
            $table->string('phone', 20)->comment("nomor telepon admin");
            $table->string('email')->comment("email admin");
            $table->text('banner')->nullable();
            $table->text('size_chart')->nullable();
            $table->text('rute')->nullable();
            $table->tinyInteger('status')->unsigned()->default(1)->comment("0: non-aktif; 1: aktif; 2: release");

            $table->dateTime('insert_at')->default(DB::raw('CURRENT_TIMESTAMP()'));
            $table->unsignedBigInteger('insert_by');
            $table->dateTime('update_at')->nullable()->useCurrentOnUpdate();
            $table->unsignedBigInteger('update_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event');
    }
};
