<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KomentarFoto extends Model
{
    protected $table = 'komentarfoto';
    protected $primaryKey = 'komentar_id';
    protected $fillable = ['foto_id', 'user_id', 'isi_komentar', 'tanggal_komentar'];

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function foto() {
        return $this->belongsTo(Foto::class, 'foto_id', 'foto_id');
    }
}
