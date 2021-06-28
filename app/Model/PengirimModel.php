<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PengirimModel extends Model
{
    protected $table = 'pengirim';

    protected $fillable = [
        'id', 'nama', 'alamat', 'hp', 'barang', 'berat', 'jumlah', 'created_at', 'updated_at'
    ];
}
