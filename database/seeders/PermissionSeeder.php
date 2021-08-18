<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;
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
        Schema::disableForeignKeyConstraints();
        Permission::truncate();
        Artisan::call('optimize:clear');

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

        /* site permision */
        Permission::create(['name' => 'site_create']);
        Permission::create(['name' => 'site_edit']);
        Permission::create(['name' => 'site_view']);
        Permission::create(['name' => 'site_delete']);

        /* report permision */
        Permission::create(['name' => 'report_site_comment']);
        Permission::create(['name' => 'comment_add']);
        Permission::create(['name' => 'report_create']);
        Permission::create(['name' => 'report_edit']);
        Permission::create(['name' => 'report_view']);
        Permission::create(['name' => 'report_delete']);

        /* setting permission */
        Permission::create(['name' => 'setting_edit']);
        Permission::create(['name' => 'setting_view']);



        Schema::enableForeignKeyConstraints();

    }
}
