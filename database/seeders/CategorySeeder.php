<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = ['Landscape', 'Portrait', 'Vintage', 'Building', 'Grayscale'];
        foreach ($categories as $category) {
            $newCategory = new Category();
            $newCategory->user_id = 1;
            $newCategory->name = $category;
            $newCategory->slug = Str::slug($newCategory->name, '-');
            $newCategory->save();
        }
    }
}
