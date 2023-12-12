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
            'role' => 'admin',
            'type' => 'guru',
            'password' => bcrypt('admin')
        ]);

        User::factory(30)->create();
    }
}
