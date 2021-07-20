<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SectionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('section')->insert([
            [
                'name' => 'Kitchen',
                'status' => 1
            ],
            [
                'name' => 'Garden',
                'status' => 1
            ],
            [
                'name' => 'Bathroom',
                'status' => 1
            ]
        ]);
    }
}
