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

        Schema::create('peserta', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_komunitas');
            $table->string('nama');
            $table->string('phone', 20);
            $table->string('email');
            $table->date('tgl_lahir');
            $table->string('nik');
            $table->enum('blood', ['A', 'B', 'AB', 'O']);
            $table->string('kota', 100);
            $table->text('alamat');
            $table->enum('gender', ['L', 'P'])->comment('L: Laki-laki; P: Perempuan');
            $table->string('nama_komunitas');
            $table->string('telp_emergency', 20);
            $table->string('hubungan_emergency', 100);
            $table->tinyInteger('status')->unsigned()->default(1)->comment("1: aktif; 0: non-aktif");

            $table->dateTime('insert_at', 3)->default(DB::raw('CURRENT_TIMESTAMP(3)'));
            $table->dateTime('update_at', 3)->nullable()->useCurrentOnUpdate();
            $table->unsignedBigInteger('update_by')->nullable();
            $table->dateTime('delete_at', 3)->nullable();
            $table->unsignedBigInteger('delete_by')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peserta');
    }
};
