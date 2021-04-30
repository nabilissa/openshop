<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            "libelle"=>"Matériels Electoniques",
            "description"=>"Ceci est une description de matériels Electroniques",
        ]);
        Category::create([
            "libelle"=>"Cosmetiques",
            "description"=>"Ceci est une description de Cosmétiques",
        ]);
        Category::create([
            "libelle"=>"Agriculture",
            "description"=>"Ceci est une description de Agriculture",
        ]);
    }
}
