<?php

namespace Database\Seeders;

use App\Models\Photo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class PhotoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        for ($i = 0; $i < 10; $i++) {
            $photo = new Photo();
            $photo->title = $faker->words(3, true);
            $photo->description = $faker->paragraphs(4, true);
            $photo->image = $faker->imageUrl(640, 400, 'Photos', true, $photo->title, true, 'jpg');
            $photo->save();
        }
    }
}
