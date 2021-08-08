<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LokasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = Carbon::now();
        DB::table('lokasi')->insert([
            'cabang' => "Admin_only",
            'alamat' => "Admin_only",
            'created_at' => $date,
            'updated_at' => $date,
        ]);
    }
}
