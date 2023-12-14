<?php

namespace Database\Seeders;

use App\Models\StudentClass;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        StudentClass::create([
            'name' => 'XI RPL 1',
            'grade' => 10,
            'major_id' => 1,
        ]);

        StudentClass::create([
            'name' => 'XI RPL 2',
            'grade' => 10,
            'major_id' => 1,
        ]);


    }
}
