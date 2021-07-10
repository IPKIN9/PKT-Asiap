<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PesanModel extends Model
{
    protected $table = 'pesan';

    protected $fillable = [
        'id', 'pesan', 'type', 'created_at', 'updated_at'
    ];
}
