<?php

namespace App\Http\Controllers;

use App\Model\LokasiModel;
use App\Model\MobilModel;
use App\Model\PengirimModel;
use App\Model\ProsesModel;
use App\Model\SupirModel;
use Illuminate\Http\Request;

class ProsesController extends Controller
{
    public function index()
    {
        $data = array(
            'pengirim' => PengirimModel::get(),
            'supir' => SupirModel::get(),
            'mobil' => MobilModel::get(),
            'lokasi' => LokasiModel::get(),
            'proses' => ProsesModel::with('pengirim_rerol', 'asal_rerol', 'tujuan_rerol', 'supir_rerol', 'mobil_rerol')->get(),
        );
        return view('Dashboard.proses')->with('data', $data);
    }
}
