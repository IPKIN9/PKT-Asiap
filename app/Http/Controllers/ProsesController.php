<?php

namespace App\Http\Controllers;

use App\Model\LokasiModel;
use App\Model\MobilModel;
use App\Model\PengirimModel;
use App\Model\ProsesModel;
use App\Model\SupirModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProsesController extends Controller
{
    public function index()
    {
        $data = array(
            'pengirim' => PengirimModel::get(),
            'supir' => SupirModel::get(),
            'mobil' => MobilModel::get(),
            'lokasi' => LokasiModel::get(),
            'proses' => ProsesModel::with('pengirim_rol', 'asal_rol', 'tujuan_rol', 'supir_rol', 'mobil_rol')->get(),
        );
        return view('Dashboard.proses')->with('data', $data);
    }

    public function insert(Request $request)
    {
        $request->validate([
            'pengirim_id' => 'required',
            'asal_id' => 'required',
            'tujuan_id' => 'required',
            'no_hp' => 'required',
            'ket' => 'required',
            'supir_id' => 'required',
            'mobil_id' => 'required',
        ]);
        $data = array(
            'no_resi' => Str::random(15),
            'pengirim_id' => $request->input('pengirim_id'),
            'asal_id' => $request->input('asal_id'),
            'tujuan_id' => $request->input('tujuan_id'),
            'no_hp' => $request->input('no_hp'),
            'ket' => $request->input('ket'),
            'supir_id' => $request->input('supir_id'),
            'mobil_id' => $request->input('mobil_id'),
            'created_at' => now(),
            'updated_at' => now(),
        );
        DB::table('proses')->insert($data);
        return redirect(route('kirim.index'))->with('status', 'Data Tersimpan');
    }

    public function edit_data($id)
    {
        $where = array('id' => $id);
        $post  = ProsesModel::where($where)->first();

        return response()->json($post);
    }

    public function update(Request $request, $id)
    {
        $data = array(
            'pemgirim_id' => $request->input('pengirim_id'),
            'asal_id' => $request->input('asal_id'),
            'tujuan_id' => $request->input('tujuan_id'),
            'no_hp' => $request->input('no_hp'),
            'ket' => $request->input('ket'),
            'supir_id' => $request->input('supir_id'),
            'mobil_id' => $request->input('mobil_id'),
            'updated_at' => now()
        );
        ProsesModel::where('id', $id)->update($data);
        return response()->json($data);
    }

    public function destroy($id)
    {
        $post = ProsesModel::where('id', $id)->delete();
        return response()->json($post);
    }
}