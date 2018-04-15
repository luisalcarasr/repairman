<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Roles
        $admin = Role::create(['name' => 'admin']);
        $supervisor = Role::create(['name' => 'supervisor']);

        // Permissions for watch the records.
        Permission::create(['name' => 'watch areas']);
        Permission::create(['name' => 'watch machines']);
        Permission::create(['name' => 'watch maintenances']);
        Permission::create(['name' => 'watch maintenance types']);
        Permission::create(['name' => 'watch users']);

        // Suspervisor role can watch all records.
        $supervisor->syncPermissions(Permission::all());

        // Permissions for create the records.
        Permission::create(['name' => 'create areas']);
        Permission::create(['name' => 'create machines']);
        Permission::create(['name' => 'create maintenances']);
        Permission::create(['name' => 'create maintenance types']);
        Permission::create(['name' => 'create users']);

        // Permissions for edit the records.
        Permission::create(['name' => 'edit areas']);
        Permission::create(['name' => 'edit machines']);
        Permission::create(['name' => 'edit maintenances']);
        Permission::create(['name' => 'edit maintenance types']);
        Permission::create(['name' => 'edit users']);

        // Permissions for delete the records.
        Permission::create(['name' => 'delete areas']);
        Permission::create(['name' => 'delete machines']);
        Permission::create(['name' => 'delete maintenances']);
        Permission::create(['name' => 'delete maintenance types']);
        Permission::create(['name' => 'delete users']);

        // Admin role can do anything.
        $admin->syncPermissions(Permission::all());

    }
}
