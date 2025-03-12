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
            $table->decimal('harga', 15, 0)->default(1);
            $table->unsignedInteger('stok')->default(1);
            $table->tinyInteger('status')->unsigned()->default(1)->comment("1: aktif; 0: non-aktif");

            $table->dateTime('insert_at')->default(DB::raw('CURRENT_TIMESTAMP()'));
            $table->unsignedBigInteger('insert_by');
            $table->dateTime('update_at')->nullable()->useCurrentOnUpdate();
            $table->unsignedBigInteger('update_by')->nullable();
            $table->dateTime('delete_at')->nullable();
            $table->unsignedBigInteger('delete_by')->nullable();

            // Indexes
            $table->index('status');
            $table->index('tgl_event');
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
