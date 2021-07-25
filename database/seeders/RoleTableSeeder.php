<?php

namespace Database\Seeders;

use App\Models\RoleHasPermission;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        Role::truncate();
        RoleHasPermission::truncate();

        $superAdmin = Role::create(['name' => 'super admin']);
        $superAdmin->givePermissionTo([
            'company_create', 'company_view', 'company_edit', 'company_delete',
            'user_create', 'user_view', 'user_edit', 'user_delete'
        ]);

        $companyAdmin = Role::create(['name' => 'company admin']);
        $companyAdmin->givePermissionTo(
            [
                'user_creation_page', 'user_create', 'user_view', 'user_edit', 'user_delete',
                'site_create', 'site_view', 'site_edit', 'site_delete',
                'report_create', 'report_view', 'report_edit', 'report_delete'
            ]
        );

        $supervisor = Role::create(['name' => 'supervisor']);
        $supervisor->givePermissionTo(
            [
                'report_create', 'report_view', 'report_edit', 'report_delete'
            ]
        );
        Role::create(['name' => 'worker']);
        $siteAdmin = Role::create(['name' => 'site admin']);
        $siteAdmin->givePermissionTo(
            [
                'report_site_comment', 'report_view',
            ]
        );

        Schema::enableForeignKeyConstraints();

    }
}
