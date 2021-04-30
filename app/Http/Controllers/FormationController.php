<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Produit;
use App\Models\User;
use Illuminate\Http\Request;

class FormationController extends Controller
{
    public function index()
    {
        abort(503);
        //$produits=Produit::all();
        //$produit=Produit::first();
        //$produit2=Produit::where(["prix"=>500000,"quantite"=>30])->get();
        //dd($produit2);


      


        $produit1 =Produit::first();

        $user1= User::first();
        $user1->produits()->attach($produit1); // lier un user à un produit
        //dd($user1->produits);// affiche les produits d'une utilisateurs
        dd($produit1->users);// affiche les utilisateurs d'un produit 


        $category1=Category::first();
        $produit1->category_id=$category1->id; // Affecte l'id de la categorie 1 a produit 1
        $produit1->save();

     



        dd($category1->produits);//affiche les prduits d'une categorie

        dd($produit1->category);// Affichier le categorie du produit 1
    }
    public function ajouterProduit()
    {
        $produit= new Produit();
        
        $produit->designation='Maxwell';
        $produit->prix=8000;
        $produit->description="Maxwell est un super café";
        $produit->quantite=50;
        $produit->save();        
        dd($produit);

    }
    public function ajouterProduit2()
    {
       $produit= Produit::create([
            "designation"=>"Ordinateur",
            "prix"=>500000,
            "description"=>"La description de ordinateur",
            "quantite"=>30,
        ]);
        dd($produit);
    }
    public function updateProduit()
    {
        $produit1=Produit::first();
        $produit1->designation="Avovita";
        $produit1->prix="1800";
        $produit1->description="Pomade féminine à base d'avocat !";
        $produit1->quantite=10;
        $produit1->save();
        dd($produit1);
    }
    
}
