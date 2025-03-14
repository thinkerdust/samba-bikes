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
        Schema::create('akses_role', function (Blueprint $table) {

            // Columns
            $table->id();
            $table->unsignedBigInteger('id_role');
            $table->string('kode_menu', 10); // Changed from referencing id to kode
            $table->tinyInteger('flag_access')->unsigned()->default(1);

            $table->dateTime('insert_at')->default(DB::raw('CURRENT_TIMESTAMP()'));
            $table->unsignedBigInteger('insert_by');

            $table->dateTime('update_at')->nullable()->useCurrentOnUpdate();
            $table->unsignedBigInteger('update_by')->nullable();

            // Relationships
            $table->foreign('id_role')->references('id')->on('role')->onDelete('cascade');
            $table->foreign('kode_menu')->references('kode')->on('menu')->onDelete('cascade'); // Updated foreign key reference

            // Indexes
            $table->index('id_role');
            $table->index('kode_menu');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('akses_role');
    }
};
