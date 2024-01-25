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
        Schema::create('surat', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('format_id')->nullable();
            $table->string('no_surat')->unique();
            $table->string('kategori_surat')->nullable();
            $table->string('nama_surat')->nullable();
            $table->string('jenis_surat')->nullable();
            $table->string('status_surat')->nullable();
            $table->string('nama_file')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat');
    }
};
