<?php

namespace App\Model;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'username', 'password', 'role', 'id_lokasi', 'created_at', 'updated_at'
    ];

    public function lokasi_rol()
    {
        return $this->belongsTo(LokasiModel::class, 'id_lokasi');
    }
}
