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
        ]); // 1

        Role::create([
            'name' => 'Guru RPL',
        ]); // 2

        Role::create([
            'name' => 'Staff TU',
        ]); // 3
        
        Role::create([
            'name' => 'KM',
        ]); // 4

        Role::create([
            'name' => 'Ketua Osis',
        ]); // 5

        Role::create([
            'name' => 'Osis',
        ]); // 6

        Role::create([
            'name' => 'Anggota Literasi',
        ]); // 7

        Role::create([
            'name' => 'Siswa',
        ]); // 8

        Role::create([
            'name' => 'Pembaca',
        ]); // 9
    }
}
