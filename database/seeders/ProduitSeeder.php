<?php

namespace Database\Seeders;

use App\Models\Produit;
use Illuminate\Database\Seeder;

class ProduitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        Produit::factory(500)->create();
        /*
        $produit=Produit::create([
            "designation"=>"Chemise",
            "prix"=>5000,
            "description"=>"Ceci est la description de la chemise",
            "quantite"=>50,
        ]);*/
    }
}
