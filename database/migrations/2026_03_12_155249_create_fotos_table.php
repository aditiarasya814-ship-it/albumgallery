<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('fotos', function (Blueprint $blueprint) {
            $blueprint->id('foto_id');
            $blueprint->string('judul_foto');
            $blueprint->text('deskripsi_foto');
            $blueprint->date('tanggal_unggah');
            $blueprint->string('lokasi_file');
            $blueprint->foreignId('album_id')->constrained('albums', 'album_id')->onDelete('cascade');
            $blueprint->foreignId('user_id')->constrained('users', 'user_id')->onDelete('cascade');

            $blueprint->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fotos');
    }
};
