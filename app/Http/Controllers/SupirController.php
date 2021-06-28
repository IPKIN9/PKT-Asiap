<?php

namespace App\Http\Controllers;

use App\Model\SupirModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SupirController extends Controller
{
    public function index()
    {
        $data = SupirModel::all();
        return view('Dashboard.supir')->with('data', $data);
    }

    public function insert(Request $request)
    {
        $request->validate([
            'nama' => 'required|max:50',
            'hp' => 'required|max:12|min:10',
            'jk' => 'required',
        ]);

        $data = array(
            'nama' => $request->input('nama'),
            'hp' => $request->input('hp'),
            'jk' => $request->input('jk'),
            'created_at' => now(),
            'updated_at' => now(),
        );
        DB::table('supir')->insert($data);
        return redirect(route('supir.index'))->with('status', 'Data Tersimpan');
    }

    public function edit_data($id)
    {
        $where = array('id' => $id);
        $post  = SupirModel::where($where)->first();

        return response()->json($post);
    }

    public function update(Request $request, $id)
    {
        $data = array(
            'nama' => $request->input('nama'),
            'hp' => $request->input('hp'),
            'jk' => $request->input('jk'),
            'updated_at' => now()
        );
        SupirModel::where('id', $id)->update($data);
        return response()->json($data);
    }

    public function destroy($id)
    {
        $post = SupirModel::where('id', $id)->delete();
        return response()->json($post);
    }
}
