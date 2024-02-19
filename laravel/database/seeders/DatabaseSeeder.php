<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\SafeExam;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(AdminRoleSeeder::class);
        $this->call(AdminUserSeeder::class);

        $this->call(EditorRoleSeeder::class);
        $this->call(EditorUserSeeder::class);
    }
}
