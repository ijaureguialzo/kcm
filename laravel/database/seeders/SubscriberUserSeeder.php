<?php

namespace Database\Seeders;

use App\Models\Feed;
use App\Models\User;
use Illuminate\Database\Seeder;

class SubscriberUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name' => 'Subscriber',
            'email' => 'subscriber@kcm.test',
            'password' => bcrypt('12345Abcde'),
            'email_verified_at' => now(),
        ]);

        $user->assignRole('subscriber');
    }
}
