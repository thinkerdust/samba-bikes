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
        Schema::create('size_chart', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 50)->comment('size');
            $table->tinyInteger('status')->default(1)->comment('1=active, 0=non active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('size_chart');
    }
};
