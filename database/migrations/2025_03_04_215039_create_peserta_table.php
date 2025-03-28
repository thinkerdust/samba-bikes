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
            $table->unsignedBigInteger('id_komunitas')->comment('relasi ke table komunitas, jika null berarti individu')->nullable();
            $table->unsignedBigInteger('id_event')->comment('relasi ke table event');
            $table->string('nama');
            $table->string('phone', 20)->nullable();
            $table->string('email')->nullable();
            $table->date('tgl_lahir');
            $table->string('nik')->note('nik harus unik pada 1 event (bisa join ke order untuk liat id_event) dipisah by id_komunitas, status peserta aktif');
            $table->enum('blood', ['A', 'B', 'AB', 'O']);
            $table->string('kota', 100)->nullable();
            $table->text('alamat')->nullable();
            $table->enum('gender', ['L', 'P'])->comment('L: Laki-laki; P: Perempuan');
            $table->string('nama_komunitas')->nullable();
            $table->string('telp_emergency', 20);
            $table->string('hubungan_emergency', 100);
            $table->string('size_jersey', 10);
            $table->tinyInteger('status')->unsigned()->default(1)->comment("1: aktif; 0: non-aktif");

            $table->dateTime('insert_at', 3)->default(DB::raw('CURRENT_TIMESTAMP(3)'));
            $table->dateTime('update_at', 3)->nullable()->useCurrentOnUpdate();
            $table->unsignedBigInteger('update_by')->nullable();

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
