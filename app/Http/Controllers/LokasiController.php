<?php

namespace App\Http\Controllers;

use App\Model\LokasiModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LokasiController extends Controller
{
    public function index()
    {
        $data = LokasiModel::all();
        return view('Dashboau8mumkrd.lokasi')->with('data', $data);
    }

    public function insert(Request $request)
    {
        $request->validate([
            'cabang' => 'required',
            'alamat' => 'required',
        ]);
        $data = array(
            'cabang' => $request->input('cabang'),
            'alamat' => $request->input('alamat'),
            'created_at' => now(),
            'updated_at' => now(),
        );
        DB::table('lokasi')->insert($data);
        return redirect(route('lokasi.index'))->with('status', 'Data Tersimpan');
    }

    public function edit_data($id)
    {
        $where = array('id' => $id);
        $post  = LokasiModel::where($where)->first();

        return response()->json($post);
    }

    public function update(Request $request, $id)
    {
        $data = array(
            'cabang' => $request->input('cabang'),
            'alamat' => $request->input('alamat'),
            'updated_at' => now()
        );
        LokasiModel::where('id', $id)->update($data);
        return response()->json($data);
    }

    public function destroy($id)
    {
        $post = LokasiModel::where('id', $id)->delete();
        return response()->json($post);
    }
}
