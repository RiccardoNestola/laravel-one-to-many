<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;


class ProjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i = 0; $i < 50; $i++) {
            $newProject = new Project();
            $newProject->title = $faker->word();
            $newProject->description = $faker->paragraph();
            $newProject->category = $faker->word();
            $newProject->year = $faker->year();
            $newProject->technology_used = $faker->word();
            $newProject->thumb = $faker->imageUrl();
            $newProject->date_added = $faker->dateTimeThisYear();
            $newProject->save();
        }
    }
}
