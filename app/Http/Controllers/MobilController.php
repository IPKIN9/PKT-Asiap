<?php

namespace App\Http\Controllers;

use App\Model\MobilModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MobilController extends Controller
{
    public function index()
    {
        $data = MobilModel::all();
        return view('Dashboard.mobil')->with('data', $data);
    }

    public function insert(Request $request)
    {
        $request->validate([
            'plat' => 'required',
            'type' => 'required',
        ]);
        $data = array(
            'plat' => $request->input('plat'),
            'type' => $request->input('type'),
            'created_at' => now(),
            'updated_at' => now(),
        );
        DB::table('mobil')->insert($data);
        return redirect(route('mobil.index'))->with('status', 'Data Tersimpan');
    }

    public function edit_data($id)
    {
        $where = array('id' => $id);
        $post  = MobilModel::where($where)->first();

        return response()->json($post);
    }

    public function update(Request $request, $id)
    {
        $data = array(
            'plat' => $request->input('plat'),
            'type' => $request->input('type'),
            'updated_at' => now()
        );
        MobilModel::where('id', $id)->update($data);
        return response()->json($data);
    }

    public function destroy($id)
    {
        $post = MobilModel::where('id', $id)->delete();
        return response()->json($post);
    }
}
