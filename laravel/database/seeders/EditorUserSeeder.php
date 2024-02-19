<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class EditorUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name' => 'Editor',
            'email' => 'editor@kbm.test',
            'password' => bcrypt('12345Abcde'),
            'email_verified_at' => now(),
        ]);

        $user->assignRole('editor');
    }
}
