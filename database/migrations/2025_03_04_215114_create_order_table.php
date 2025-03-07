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
            $table->string('order_id');
            $table->unsignedBigInteger('id_event');
            $table->unsignedBigInteger('id_peserta');
            $table->decimal('total', 15, 2)->comment("total harga");
            $table->string('metode_bayar', 50)->comment("pilhan bank ex: BCA");
            $table->string('id_rekening', 50)->comment("id rekening bank customer");
            $table->tinyInteger('status')->unsigned()->default(1)->comment("1: pending; 2: terbayarkan; 3: terkonfiramasi");
            $table->text('keterangan')->nullable();
            
            $table->dateTime('insert_at')->default(DB::raw('CURRENT_TIMESTAMP()'));
            $table->unsignedBigInteger('insert_by');
            $table->dateTime('update_at')->nullable()->useCurrentOnUpdate();
            $table->unsignedBigInteger('update_by')->nullable();
            $table->dateTime('delete_at')->nullable();
            $table->unsignedBigInteger('delete_by')->nullable();

            // Relations
            $table->foreign('id_event')->references('id')->on('event')->onDelete('cascade');
            $table->foreign('id_peserta')->references('id')->on('peserta')->onDelete('cascade');

            // Indexes
            $table->index('order_id');
            $table->index('id_event');
            $table->index('id_peserta');
            $table->index('status');

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
