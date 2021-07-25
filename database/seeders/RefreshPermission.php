<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RefreshPermission extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            PermissionSeeder::class,
            RoleTableSeeder::class,
        ]);
    }
}
