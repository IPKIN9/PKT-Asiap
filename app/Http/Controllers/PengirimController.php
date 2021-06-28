<?php

namespace App\Http\Controllers;

use App\Model\PengirimModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PengirimController extends Controller
{
    public function index()
    {
        $data = PengirimModel::all();
        return view('Dashboard.pengirim')->with('data', $data);
    }

    public function insert(Request $request)
    {
        $request->validate([
            'nama' => 'required|max:50',
            'alamat' => 'required',
            'hp' => 'required|max:12|min:10',
            'barang' => 'required',
            'berat' => 'required',
            'jumlah' => 'required',
        ]);
        $data = array(
            'nama' => $request->input('nama'),
            'alamat' => $request->input('alamat'),
            'hp' => $request->input('hp'),
            'barang' => $request->input('barang'),
            'jumlah' => $request->input('jumlah'),
            'berat' => $request->input('berat'),
            'created_at' => now(),
            'updated_at' => now(),
        );
        DB::table('pengirim')->insert($data);
        return redirect(route('pengirim.index'))->with('status', 'Data Tersimpan');
    }

    public function edit_data($id)
    {
        $where = array('id' => $id);
        $post  = PengirimModel::where($where)->first();

        return response()->json($post);
    }

    public function update(Request $request, $id)
    {
        $data = array(
            'nama' => $request->input('nama'),
            'alamat' => $request->input('alamat'),
            'hp' => $request->input('hp'),
            'berat' => $request->input('berat'),
            'barang' => $request->input('barang'),
            'jumlah' => $request->input('jumlah'),
            'updated_at' => now()
        );
        PengirimModel::where('id', $id)->update($data);
        return response()->json($data);
    }

    public function destroy($id)
    {
        $post = PengirimModel::where('id', $id)->delete();
        return response()->json($post);
    }
}
