<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class EmployeeTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('employee_type')->insert([
            [
                'name' => 'Company Admin',
                'status' => 1
            ],
            [
                'name' => 'Supervisor',
                'status' => 1
            ],
            [
                'name' => 'Worker',
                'status' => 1
            ]
        ]);
    }
}
