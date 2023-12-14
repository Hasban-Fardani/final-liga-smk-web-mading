<?php

namespace Database\Seeders;

use App\Models\StudentDetail;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        StudentDetail::create([
            'full_name' => "Fardan",
            'gender' => "male",
            'nis' => "12345",
            'ext_id' => 1,
            'class_id' => 1,
        ]);
    }
}
