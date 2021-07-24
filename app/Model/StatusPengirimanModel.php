<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class StatusPengirimanModel extends Model
{
    protected $table = 'status_pengiriman';

    protected $fillable = [
        'id', 'status_pengiriman', 'ket', 'created_at', 'updated_at'
    ];
}
