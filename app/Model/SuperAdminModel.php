<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class SuperAdminModel extends Model
{
    protected $table = 'super_admin';

    protected $fillable = [
        'name', 'username', 'password', 'role', 'created_at', 'updated_at'
    ];
}
