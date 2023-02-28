<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
class TypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $typeArray = ['Wordpress','full-stack','front-end', 'back-end'];

        foreach ($typeArray as $type) {
            $newType = new Type();
            $newType->name = $type;
            $newType->save();
        }
    }
}