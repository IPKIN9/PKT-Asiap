<?php

namespace App\Model;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'username', 'password', 'role', 'tujuan_id', 'created_at', 'updated_at'
    ];

    public function tujuan_rol()
    {
        return $this->belongsTo(LokasiModel::class, 'tujuan_id');
    }
}
