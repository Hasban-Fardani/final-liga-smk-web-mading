<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        User::create([
            'email' => 'admin@localhost',
            'username' => 'admin',
            'role_id' => 1,
            'permission' => 'admin',
            'type' => 'guru',
            'password' => bcrypt('admin')
        ]);

        User::create([
            'email' => 'creator@localhost',
            'username' => 'creator',
            'role_id' => 4,
            'permission' => 'creator',
            'type' => 'siswa',
            'password' => bcrypt('creator')
        ]);

        User::create([
            'email' => 'user@localhost',
            'username' => 'user',
            'role_id' => 4,
            'permission' => 'user',
            'type' => 'siswa',
            'password' => bcrypt('user')
        ]);

        User::factory(30)->create();
    }
}
