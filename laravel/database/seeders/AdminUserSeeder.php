<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name' => 'Admin',
            'email' => 'admin@kcm.test',
            'password' => bcrypt('12345Abcde'),
            'email_verified_at' => now(),
        ]);

        $user->assignRole('admin');
    }
}
