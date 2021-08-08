<?php

namespace App\Http\Controllers;

use App\Model\LokasiModel;
use App\Model\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SuperAdminController extends Controller
{
    public function index()
    {
        $data = array(
            'user' => User::with('lokasi_rol')->get(),
            'lokasi' => LokasiModel::all(),
        );
        return view('Dashboard.super')->with('data', $data);
    }

    public function insert(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3|max:35',
            'username' => 'required|unique:users,username',
            'password' => 'required',
            'role' => 'required',
        ]);
        $data = array(
            'name' => $request->input('name'),
            'username' => $request->input('username'),
            'password' => Hash::make($request->password),
            'role' => $request->input('role'),
            'id_lokasi' => $request->input('id_lokasi'),
            'created_at' => now(),
            'updated_at' => now(),
        );
        DB::table('users')->insert($data);
        return redirect(route('super.index'))->with('status', 'Data Tersimpan');
    }

    public function edit_data($id)
    {
        $where = array('id' => $id);
        $post  = User::where($where)->first();

        return response()->json($post);
    }

    public function update(Request $request, $id)
    {
        $data = array(
            'name' => $request->input('name'),
            'username' => $request->input('username'),
            'password' => Hash::make($request->password),
            'role' => $request->input('role'),
            'id_lokasi' => $request->input('id_lokasi'),
            'updated_at' => now()
        );
        User::where('id', $id)->update($data);
        return response()->json($data);
    }

    public function destroy($id)
    {
        $user = Auth::user()->id;
        if ($id == $user) {
            return response()->json("error", 500);
        }
        $post = User::where('id', $id)->delete();
        return response()->json($post);
    }
}
