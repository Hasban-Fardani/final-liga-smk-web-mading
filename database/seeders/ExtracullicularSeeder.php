<?php

namespace Database\Seeders;

use App\Models\Extracullicular;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExtracullicularSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Extracullicular::create([
            "name" => "IRMA",
            "type" => "organization",
        ]);

        Extracullicular::create([
            "name" => "OSIS",
            "type" => "organization",
        ]);

        Extracullicular::create([
            "name" => "MPK",
            "type" => "organization",
        ]);

        
    }
}
