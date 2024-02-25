<?php

namespace Database\Seeders;

use App\Models\Compilation;
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
        $subscriber = User::where('name', 'Subscriber')->firstOrFail();

        $rol = Role::where('name', 'subscriber')->firstOrFail();

        $repository = Repository::create([
            'title' => 'Tecnología',
            'description' => 'Repositorio con noticias sobre el mundo tecnológico en general.',
            'public' => false,
            'user_id' => $editor->id,
        ]);

        $admin->subscribed_repositories()->attach($repository->id, ['role_id' => $rol->id]);
        $subscriber->subscribed_repositories()->attach($repository->id, ['role_id' => $rol->id]);

        Compilation::create([
            'title' => 'Newsletter #1',
            'repository_id' => $repository->id,
        ]);

        Compilation::create([
            'title' => 'Newsletter #2',
            'published' => now(),
            'repository_id' => $repository->id,
        ]);

        Compilation::create([
            'title' => 'Newsletter #3',
            'repository_id' => $repository->id,
        ]);

        $repository = Repository::create([
            'title' => 'Ciberseguridad',
            'description' => 'Repositorio con noticias sobre ciberseguridad.',
            'public' => false,
            'user_id' => $editor->id,
        ]);

        Compilation::create([
            'title' => 'Newsletter semanal #1',
            'repository_id' => $repository->id,
        ]);

        $subscriber->subscribed_repositories()->attach($repository->id, ['role_id' => $rol->id]);

        $repository = Repository::create([
            'title' => 'Programación',
            'description' => 'Repositorio con noticias sobre desarrollo de software.',
            'public' => false,
            'user_id' => $editor->id,
        ]);
    }
}
