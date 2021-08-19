<?php

namespace App\Http\Controllers;

use App\Model\LokasiModel;
use App\Model\PesanModel;
use App\Model\ProsesModel;
use App\Model\StatusPengirimanModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class DashboardController extends Controller
{
    public function index()
    {
        $role = Auth::user()->role;
        $cbg = Auth::user()->id_lokasi;
        $date = Carbon::now()->toDateString();
        if ($role == 'admin') {
            $data = array(
                'proses' => ProsesModel::where('tujuan_id', $cbg)->get(),
                'today' => ProsesModel::where('created_at', $date)->get(),
                'date' => $date,
            );
        } else {
            $data = array(
                'proses' => ProsesModel::all(),
                'today' => ProsesModel::where('created_at', $date),
                'date' => $date,
            );
        }

        return view('Dashboard.home')->with('data', $data);
    }

    public function update($id)
    {
        $date = Carbon::now();
        $where = StatusPengirimanModel::where('status_pengiriman', 'tiba')->value('id');
        $proses = ProsesModel::where('id', $id)->first();
        $lokasi = LokasiModel::where('id', Auth::user()->id_lokasi)->first();
        $no = $proses->hp;
        $get_pesan = PesanModel::where('type', 'tiba')->value('pesan');
        $pesan = $get_pesan . '%0aBarang kamu dengan nomor resi: ' . $proses->no_resi .
            ' siap diantarkan, Pastikan kamu stay dirumah saat pengantaran yah. Atau kamu bisa menjemput barangmu di kantor %0a%0aCabang: ' . $lokasi->cabang .
            '%0aAlamat: ' . $lokasi->alamat . '%0a%0aTerima kasih';
        $data = array(
            'status_id' => $where,
            'updated_at' => $date
        );
        $response = Http::post('http://localhost:8081/ex/v1/notification', [
            'channel' => 'whatsapp',
            'souce' => 'biz-otoraja',
            'payload' => [
                'to' => $no,
                'is_shm' => false,
                'text' => $pesan
            ],
        ])->json();
        ProsesModel::where('id', $id)->update($data);
        return response()->json($response);
    }
}
