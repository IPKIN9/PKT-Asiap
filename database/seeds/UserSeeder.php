<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = Carbon::now();
        DB::table('users')->insert([
            'name' => "Super Admin",
            'username' => 'request_superadmin',
            'role' => 'super admin',
            'id_lokasi' => 1,
            'password' => Hash::make('request_pass'),
            'created_at' => $date,
            'updated_at' => $date,
        ]);
    }
}
