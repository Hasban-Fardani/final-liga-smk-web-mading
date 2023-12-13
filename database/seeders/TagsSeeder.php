<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Tag::create([
            'name' => 'Komunitas Literasi'
        ]);

        Tag::create([
            'name' => 'OSIS/MPK'
        ]);
        
        Tag::create([
            'name' => 'IRMA'
        ]);
        
        Tag::create([
            'name' => 'Pengembangan'
        ]);

        Tag::create([
            'name' => 'Cerita'
        ]);

    }
}
