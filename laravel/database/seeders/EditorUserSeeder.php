<?php

namespace Database\Seeders;

use App\Models\Feed;
use App\Models\User;
use Illuminate\Database\Seeder;

class EditorUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name' => 'Editor',
            'email' => 'editor@kcm.test',
            'password' => bcrypt('12345Abcde'),
            'email_verified_at' => now(),
        ]);

        $user->assignRole('editor');

        Feed::create([
            'title' => 'El País',
            'url' => 'https://feeds.elpais.com/mrss-s/pages/ep/site/elpais.com/section/ultimas-noticias/portada',
            'user_id' => $user->id,
        ]);

        Feed::create([
            'title' => 'El Correo',
            'url' => 'https://www.elcorreo.com/rss/2.0/portada/',
            'user_id' => $user->id,
        ]);

        Feed::create([
            'title' => 'BBC News',
            'url' => 'http://feeds.bbci.co.uk/news/rss.xml',
            'user_id' => $user->id,
        ]);

        Feed::create([
            'title' => 'Tecnalia',
            'url' => 'https://cms.tecnalia.com/feed/?post_type=news&lang=es',
            'user_id' => $user->id,
        ]);

        Feed::create([
            'title' => 'Xataka',
            'url' => 'https://feeds.weblogssl.com/xataka2',
            'user_id' => $user->id,
        ]);

        Feed::create([
            'title' => 'Enpresa Digitala',
            'url' => 'https://enpresadigitala.spri.eus/es/rss/',
            'user_id' => $user->id,
        ]);
    }
}
