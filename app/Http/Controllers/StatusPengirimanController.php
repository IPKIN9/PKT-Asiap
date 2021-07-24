<?php

namespace App\Http\Controllers;

use App\Model\StatusPengirimanModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StatusPengirimanController extends Controller
{
    public function index()
    {
        $data = StatusPengirimanModel::all();
        return view('Dashboard.status')->with('data', $data);
    }

    public function insert(Request $request)
    {
        $request->validate([
            'status_pengiriman' => 'required',
            'ket' => 'required',
        ]);
        $data = array(
            'status_pengiriman' => $request->input('status_pengiriman'),
            'ket' => $request->input('ket'),
            'created_at' => now(),
            'updated_at' => now(),
        );
        DB::table('status_pengiriman')->insert($data);
        return redirect(route('status.index'))->with('status', 'Data Tersimpan');
    }

    public function edit_data($id)
    {
        $where = array('id' => $id);
        $post  = StatusPengirimanModel::where($where)->first();

        return response()->json($post);
    }

    public function update(Request $request, $id)
    {
        $data = array(
            'status_pengiriman' => $request->input('status_pengiriman'),
            'ket' => $request->input('ket'),
            'updated_at' => now()
        );
        StatusPengirimanModel::where('id', $id)->update($data);
        return response()->json($data);
    }

    public function destroy($id)
    {
        $post = StatusPengirimanModel::where('id', $id)->delete();
        return response()->json($post);
    }
}
