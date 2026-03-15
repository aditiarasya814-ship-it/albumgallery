<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    protected $table = 'albums';
    protected $primaryKey = 'album_id';
    protected $fillable = ['nama_album', 'deskripsi', 'tanggal_dibuat', 'user_id'];

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function fotos() {
        return $this->hasMany(Foto::class, 'album_id', 'album_id');
    }
}