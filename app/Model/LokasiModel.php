<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class LokasiModel extends Model
{
    protected $table = 'lokasi';

    protected $fillable = [
        'id', 'cabang', 'alamat', 'created_at', 'updated_at'
    ];
}
