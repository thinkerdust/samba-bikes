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
            $table->string('kode_order');
            $table->unsignedBigInteger('id_event');
            $table->decimal('total', 15, 0)->comment("total harga");
            $table->tinyInteger('status')->unsigned()->default(1)->comment("1: pending; 2: terbayarkan; 3: terkonfiramasi");
            
            $table->dateTime('insert_at')->default(DB::raw('CURRENT_TIMESTAMP()'));
            $table->dateTime('update_at')->nullable()->useCurrentOnUpdate();
            $table->unsignedBigInteger('update_by')->nullable();
            $table->dateTime('delete_at')->nullable();
            $table->unsignedBigInteger('delete_by')->nullable();

            // Relations
            $table->foreign('id_event')->references('id')->on('event')->onDelete('cascade');

            // Indexes
            $table->index('kode_order');
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
