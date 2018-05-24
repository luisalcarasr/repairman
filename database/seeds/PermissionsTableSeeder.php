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

        // Permissions for read the records.
        Permission::create(['name' => 'read areas']);
        Permission::create(['name' => 'read files']);
        Permission::create(['name' => 'read machines']);
        Permission::create(['name' => 'read maintenances']);
        Permission::create(['name' => 'read maintenance types']);
        Permission::create(['name' => 'read users']);

        // Suspervisor role can read all records.
        $supervisor->syncPermissions(Permission::all());

        // Permissions for write the records.
        Permission::create(['name' => 'write areas']);
        Permission::create(['name' => 'write files']);
        Permission::create(['name' => 'write machines']);
        Permission::create(['name' => 'write maintenances']);
        Permission::create(['name' => 'write maintenance types']);
        Permission::create(['name' => 'write users']);

        // Permissions for delete the records.
        Permission::create(['name' => 'delete areas']);
        Permission::create(['name' => 'delete files']);
        Permission::create(['name' => 'delete machines']);
        Permission::create(['name' => 'delete maintenances']);
        Permission::create(['name' => 'delete maintenance types']);
        Permission::create(['name' => 'delete users']);

        // Admin role can do anything.
        $admin->syncPermissions(Permission::all());

    }
}
