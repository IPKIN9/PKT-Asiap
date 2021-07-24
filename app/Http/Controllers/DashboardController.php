<?php

namespace App\Http\Controllers;

use App\Model\ProsesModel;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $date = Carbon::now()->toDateString();
        $data = array(
            'proses' => ProsesModel::take(5)->get(),
            'today' => ProsesModel::where('created_at', $date),
            'date' => $date,
        );
        return view('Dashboard.home')->with('data', $data);
    }
}
