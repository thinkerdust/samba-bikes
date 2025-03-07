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
            $table->string('email');
            $table->string('nama');
            $table->string('tempat_lahir', 100);
            $table->date('tgl_lahir');
            $table->string('telp', 20);
            $table->text('alamat');
            $table->tinyInteger('jenis_kelamin')->unsigned()->comment('1: Laki-laki; 2: Perempuan');
            $table->tinyInteger('status')->unsigned()->default(1)->comment("1: aktif; 0: non-aktif");

            $table->dateTime('insert_at', 3)->default(DB::raw('CURRENT_TIMESTAMP(3)'));
            $table->unsignedBigInteger('insert_by');
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
