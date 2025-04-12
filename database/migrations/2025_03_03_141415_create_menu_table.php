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
        Schema::create('menu', function (Blueprint $table) {
            $table->id(); // default from laravel will give auto increment and primary key to id
            $table->string('kode', 10)->unique(); // Ensure kode is unique
            $table->string('kode_parent', 10)->nullable(); // is not giving nullable by default is not nullable
            $table->string('nama', 100);
            $table->text('icon');
            $table->text('url');
            $table->tinyInteger('status')->unsigned()->default(1)->comment("1: aktif; 0: non-aktif");

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
        Schema::dropIfExists('menu');
    }
};
