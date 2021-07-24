<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ProsesModel extends Model
{
    protected $table = 'proses';
    protected $fillable = [
        'id', 'no_resi', 'pengirim_id', 'asal_id', 'tujuan_id',
        'no_hp', 'ket', 'supir_id', 'mobil_id', 'penerima', 'hp', 'alamat', 'created_at', 'updated_at'
    ];
    public function pengirim_rol()
    {
        return $this->belongsTo(PengirimModel::class, 'pengirim_id');
    }
    public function asal_rol()
    {
        return $this->belongsTo(LokasiModel::class, 'asal_id');
    }
    public function tujuan_rol()
    {
        return $this->belongsTo(LokasiModel::class, 'tujuan_id');
    }
    public function supir_rol()
    {
        return $this->belongsTo(SupirModel::class, 'supir_id');
    }
    public function mobil_rol()
    {
        return $this->belongsTo(MobilModel::class, 'mobil_id');
    }
}
