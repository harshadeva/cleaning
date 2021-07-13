<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user')->insert([
            'first_name' => 'super',
            'last_name' => 'admin',
            'email' => 'admin@cleaning.lk',
            'password' => Hash::make('12345678'),
            'status' => 1
        ]);
        User::first()->assignRole('super admin');
    }
}
