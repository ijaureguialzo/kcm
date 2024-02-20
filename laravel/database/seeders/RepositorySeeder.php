<?php

namespace Database\Seeders;

use App\Models\Repository;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RepositorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::where('name', 'Admin')->firstOrFail();
        $editor = User::where('name', 'Editor')->firstOrFail();
        $rol = Role::where('name', 'subscriber')->firstOrFail();

        $repository = Repository::create([
            'title' => 'Tecnología',
            'description' => 'Repositorio con noticias sobre el mundo tecnológico en general.',
            'public' => false,
            'user_id' => $editor->id,
        ]);

        $admin->subscribed_repositories()->attach($repository->id, ['role_id' => $rol->id]);
    }
}
