<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class SupirModel extends Model
{
    protected $table = 'supir';

    protected $fillable = [
        'id', 'nama', 'hp', 'jk', 'created_at', 'updated_at'
    ];
}
