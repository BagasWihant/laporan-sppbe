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
        Schema::create('laporan_rabs', function (Blueprint $table) {
            $table->id();
            $table->string('title',50);
            $table->string('subtitle',50);
            $table->bigInteger('to')->comment('ditujukan');
            $table->json('isi');
            $table->json('ttd')->comment('[nama,file]');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan_rabs');
    }
};
