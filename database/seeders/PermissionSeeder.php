<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /* company permision */
        Permission::create(['name' => 'company_create']);
        Permission::create(['name' => 'company_edit']);
        Permission::create(['name' => 'company_view']);
        Permission::create(['name' => 'company_delete']);

        /* user permission */
        Permission::create(['name' => 'user_creation_page']);
        Permission::create(['name' => 'user_create']);
        Permission::create(['name' => 'user_view']);
        Permission::create(['name' => 'user_edit']);
        Permission::create(['name' => 'user_delete']);

    }
}
