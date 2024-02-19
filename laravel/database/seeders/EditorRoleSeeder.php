<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class EditorRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role = Role::create(['name' => 'editor']);

        $permissions = [
            'feed-list', 'feed-create', 'feed-edit', 'feed-delete',
        ];

        foreach ($permissions as $p) {
            $permission = Permission::create(['name' => $p]);
            $permission->assignRole($role);
        }
    }
}
