<?php

namespace App\Http\Controllers;

use App\Model\PesanModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PesanController extends Controller
{
    public function index()
    {
        $data = PesanModel::all();
        return view('Dashboard.pesan')->with('data', $data);
    }

    public function insert(Request $request)
    {
        $request->validate([
            'pesan' => 'required',
            'type' => 'required',
        ]);
        $data = array(
            'pesan' => $request->input('pesan'),
            'type' => $request->input('type'),
            'created_at' => now(),
            'updated_at' => now(),
        );
        DB::table('pesan')->insert($data);
        return redirect(route('pesan.index'))->with('status', 'Data Tersimpan');
    }

    public function edit_data($id)
    {
        $where = array('id' => $id);
        $post  = PesanModel::where($where)->first();

        return response()->json($post);
    }

    public function update(Request $request, $id)
    {
        $data = array(
            'pesan' => $request->input('pesan'),
            'type' => $request->input('type'),
            'updated_at' => now()
        );
        PesanModel::where('id', $id)->update($data);
        return response()->json($data);
    }

    public function destroy($id)
    {
        $post = PesanModel::where('id', $id)->delete();
        return response()->json($post);
    }
}
