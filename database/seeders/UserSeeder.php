<?php

namespace Database\Seeders;

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
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@dev.com',
             'role'=>'admin',
            'password' => Hash::make(12345678),
        ]);
        DB::table('users')->insert([
            'name' => 'Nirbhay',
            'email' => 'nirbhay.skyview@gmail.com',
            'password' => Hash::make(12345678),
        ]);
    }
}