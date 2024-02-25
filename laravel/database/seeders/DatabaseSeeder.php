<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

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

        $this->call(SubscriberRoleSeeder::class);
        $this->call(SubscriberUserSeeder::class);

        $this->call(RepositorySeeder::class);
    }
}
