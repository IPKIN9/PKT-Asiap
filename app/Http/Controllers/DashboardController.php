<?php

namespace App\Http\Controllers;

use App\Model\ProsesModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $role = Auth::user()->role;
        $cbg = Auth::user()->id_lokasi;
        $date = Carbon::now()->toDateString();
        if ($role == 'admin') {
            $data = array(
                'proses' => ProsesModel::where('tujuan_id', $cbg)->get(),
                'today' => ProsesModel::where('created_at', $date)->get(),
                'date' => $date,
            );
        } else {
            $data = array(
                'proses' => ProsesModel::all(),
                'today' => ProsesModel::where('created_at', $date),
                'date' => $date,
            );
        }

        return view('Dashboard.home')->with('data', $data);
    }
}
