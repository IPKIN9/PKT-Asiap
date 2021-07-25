<?php

namespace App\Http\Controllers;

use App\Model\SuperAdminModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SuperAdminController extends Controller
{
    public function index()
    {
        $data = SuperAdminModel::all();
        return view('Dashboard.super')->with('data', $data);
    }

    public function insert(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3|max:35',
            'username' => 'required|unique:super_admin',
            'password' => 'required',
            'role' => 'required',
        ]);
        $data = array(
            'name' => $request->input('name'),
            'username' => $request->input('username'),
            'password' => Hash::make($request->password),
            'role' => $request->input('role'),
            'created_at' => now(),
            'updated_at' => now(),
        );
        DB::table('super_admin')->insert($data);
        return redirect(route('super.index'))->with('status', 'Data Tersimpan');
    }

    public function edit_data($id)
    {
        $where = array('id' => $id);
        $post  = SuperAdminModel::where($where)->first();

        return response()->json($post);
    }

    public function update(Request $request, $id)
    {
        $data = array(
            'name' => $request->input('name'),
            'username' => $request->input('username'),
            'password' => Hash::make($request->password),
            'role' => $request->input('role'),
            'updated_at' => now()
        );
        SuperAdminModel::where('id', $id)->update($data);
        return response()->json($data);
    }

    public function destroy($id)
    {
        $post = SuperAdminModel::where('id', $id)->delete();
        return response()->json($post);
    }
}
