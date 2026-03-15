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
        Schema::create('albums', function (Blueprint $blueprint) {
            $blueprint->id('album_id');
            $blueprint->string('nama_album');
            $blueprint->text('deskripsi');
            $blueprint->date('tanggal_dibuat');
            $blueprint->foreignId('user_id')->constrained('users', 'user_id')->onDelete('cascade');

            $blueprint->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('albums');
    }
};
