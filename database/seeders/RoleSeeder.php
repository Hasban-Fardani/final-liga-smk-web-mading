<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Role::create([
            'name' => 'admin',
        ]);

        Role::create([
            'name' => 'Guru RPL',
        ]);
        
        Role::create([
            'name' => 'KM',
        ]);

        Role::create([
            'name' => 'Ketua Osis',
        ]);

        Role::create([
            'name' => 'Osis',
        ]);

        Role::create([
            'name' => 'Anggota Literasi',
        ]);
    }
}
