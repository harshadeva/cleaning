<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            PermissionSeeder::class,
            RoleTableSeeder::class,
            UserTableSeeder::class,
            EmployeeTypeSeeder::class,
            SectionTableSeeder::class
        ]);
    }
}
