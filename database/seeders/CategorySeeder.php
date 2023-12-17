<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Category::create([
            'name' => 'Pengumuman',
            'priority' => 1,
            'slug' => 'pengumuman',
        ]);

        Category::create([
            'name' => 'Prestasi',
            'priority' => 2,
            'slug' => 'prestasi',
        ]);

        Category::create([
            'name' => 'Buletin',
            'priority' => 2,
            'slug' => 'Buletin',
        ]);

        Category::create([
            'name' => 'artikel',
            'priority' => 3,
            'slug' => 'artikel',
        ]);
    }
}
