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
            'color' => 'primary',
            'slug' => 'pengumuman',
        ]);

        Category::create([
            'name' => 'Prestasi',
            'color' => 'secondary',
            'slug' => 'prestasi',
        ]);

        Category::create([
            'name' => 'Buletin',
            'color' => 'secodary',
            'slug' => 'Buletin',
        ]);

        Category::create([
            'name' => 'artikel',
            'color' => 'other',
            'slug' => 'artikel',
        ]);
    }
}
