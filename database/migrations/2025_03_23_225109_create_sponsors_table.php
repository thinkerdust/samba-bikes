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
        Schema::create('sponsor', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_event');
            $table->text('filename');
            $table->mediumInteger('size')->unsigned();
            $table->dateTime('insert_at')->useCurrent();
            $table->unsignedBigInteger('insert_by');

            // Relations
            $table->foreign('id_event')->references('id')->on('event')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sponsor');
    }
};
