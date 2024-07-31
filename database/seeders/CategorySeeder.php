<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Category;



class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Penyelamatan Hewan', 'slug' => Str::slug('Penyelamatan Hewan'), 'icon' => 'icons/icon animals rescue.png'],
            ['name' => 'Proyek Bangunan', 'slug' => Str::slug('Proyek Bangunan'), 'icon' => 'icons/icon building project.png'],
            ['name' => 'Bencana Alam', 'slug' => Str::slug('Bencana Alam'), 'icon' => 'icons/icon natural disasters.png'],
            ['name' => 'Pendidikan', 'slug' => Str::slug('Pendidikan'), 'icon' => 'icons/icon education.png'],
            ['name' => 'Perawatan Medis', 'slug' => Str::slug('Perawatan Medis'), 'icon' => 'icons/icon medical treatment.png'],
            ['name' => 'Bisnis Kecil', 'slug' => Str::slug('Bisnis Kecil'), 'icon' => 'icons/icon small business.png'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
