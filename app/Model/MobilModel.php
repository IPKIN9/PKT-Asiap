<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class MobilModel extends Model
{
    protected $table = 'mobil';

    protected $fillable = [
        'id', 'plat', 'type', 'created_at', 'updated_at'
    ];
}
