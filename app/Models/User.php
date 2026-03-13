<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'username',
        'password',
        'email',
        'nama_lengkap',
        'alamat',
    ];

    public function albums()
    {
        return $this->hasMany(Album::class, 'user_id', 'id');
    }

    public function fotos()
    {
        return $this->hasMany(Foto::class, 'user_id', 'id');
    }
}