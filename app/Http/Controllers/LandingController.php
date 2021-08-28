<?php

namespace App\Http\Controllers;

use App\Model\ProsesModel;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index()
    {
        return view("Users.landing");
    }

    public function search_resi($id)
    {
        $search = ProsesModel::where('no_resi', $id)->with('pengirim_rol', 'status_rol')-> first();
        return response()->json($search);
    }
}
