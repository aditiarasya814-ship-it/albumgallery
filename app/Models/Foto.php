<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Foto extends Model
{
    protected $table = 'fotos';
    protected $primaryKey = 'foto_id';
    protected $fillable = [
        'judul_foto', 'deskripsi_foto', 'tanggal_unggah', 'lokasi_file', 'album_id', 'user_id'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function album() {
        return $this->belongsTo(Album::class, 'album_id', 'album_id');
    }

    public function komentars() {
        return $this->hasMany(KomentarFoto::class, 'foto_id', 'foto_id');
    }

    public function likes() {
        return $this->hasMany(LikeFoto::class, 'foto_id', 'foto_id');
    }
}
