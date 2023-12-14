<?php

namespace Database\Seeders;

use App\Models\TeacherDetail;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        TeacherDetail::create([
            'full_name' => 'Engkus Kusnadi',
            'gender' => 'male',
            'nip' => 123456789,
        ]);

        TeacherDetail::create([
            'full_name' => 'Hima',
            'gender' => 'female',
            'nip' => 123456789,
        ]);
    }
}
