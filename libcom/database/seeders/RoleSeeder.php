<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("model_has_roles")->truncate();
        app()[PermissionRegistrar::class]->forgetCachedPermissions();
        Permission::query()->truncate();
        Role::query()->truncate();
        Permission::create(['name' => 'edit articles']);
        Permission::create(['name' => 'delete articles']);
        Permission::create(['name' => 'add articles']);
        Permission::create(['name' => 'read articles']);
        $role = Role::create(['name' => 'admin'])
            ->givePermissionTo(Permission::all());
        $role = Role::create(['name' => 'non-admin'])
            ->givePermissionTo(['read articles']);

    }
}
