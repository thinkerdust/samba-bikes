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
            $table->string('order_id');
            $table->unsignedBigInteger('id_event_tiket');
            $table->decimal('harga', 15, 2)->comment("harga per tiket");
            $table->unsignedInteger('jumlah')->comment("total tiket");
            $table->tinyInteger('status')->unsigned()->default(1)->comment("1: aktif; 0: non-aktif;");

            $table->dateTime('insert_at')->default(DB::raw('CURRENT_TIMESTAMP()'));
            $table->unsignedBigInteger('insert_by');
            $table->dateTime('update_at')->nullable()->useCurrentOnUpdate();
            $table->unsignedBigInteger('update_by')->nullable();
            $table->dateTime('delete_at')->nullable();
            $table->unsignedBigInteger('delete_by')->nullable();

            // Relations
            $table->foreign('order_id')->references('order_id')->on('order')->onDelete('cascade');
            $table->foreign('id_event_tiket')->references('id')->on('event_tiket')->onDelete('cascade');

            // Indexes
            $table->index('order_id');
            $table->index('id_event_tiket');
            $table->index('status');

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
