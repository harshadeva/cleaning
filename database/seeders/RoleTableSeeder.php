<?php

namespace Database\Seeders;

use Spatie\Permission\Models\Role;
use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superAdmin = Role::create(['name' => 'super admin']);
        $superAdmin->givePermissionTo([
            'company_create', 'company_view', 'company_edit', 'company_delete',
            'user_create', 'user_view', 'user_edit', 'user_delete'
        ]);

        $companyAdmin = Role::create(['name' => 'company admin']);
        $companyAdmin->givePermissionTo(
            [
                'user_creation_page', 'user_create', 'user_view', 'user_edit', 'user_delete'
            ]
        );

        Role::create(['name' => 'supervisor']);
        Role::create(['name' => 'worker']);
        Role::create(['name' => 'site admin']);
    }
}
