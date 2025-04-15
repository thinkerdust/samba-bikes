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
        Schema::create('role', function (Blueprint $table) {
            $table->id(); // bigint unsigned primary key
            $table->string('nama', 100);
            $table->tinyInteger('status')->unsigned()->default(1)->comment('1: aktif; 0: non-aktif');

            $table->dateTime('insert_at')->useCurrent();
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
        Schema::dropIfExists('role');
    }
};
