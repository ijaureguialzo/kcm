<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class SubscriberRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role = Role::create(['name' => 'subscriber']);

        $permissions = [
            'repository-list',
            'repository-subscribe',
            'repository-unsubscribe',
        ];

        foreach ($permissions as $p) {
            $permission = Permission::updateOrCreate(['name' => $p]);
            $permission->assignRole($role);
        }
    }
}
