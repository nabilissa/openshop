<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use App\Models\User;

class MainController extends Controller
{
    public function accueil()
    {
        $user = User::orderByDesc('id')->first();
        // dd($user->isAdmin());
        $collection1 = collect(['orange', 'Banane', 'Avocat', 'Mangues']);
        //$collection2 = Produit::all();

        $produit = Produit::all();
        $produitFiltres = $produit->filter(function ($produit, $key) {
            //icion affecte a  $produitFiltres les produit dont le prix est superieur à 100000 et inferieur à 500000
            return $produit->prix > 100000 && $produit->prix < 500000;
        });
       // dd($produitFiltres);
        // dd($collection2->where('designation', 'avovita')->first()); //methode avg, min, sortBy, sortByDesc(), max,

        $produit = Produit::orderByDesc('id')->take(9)->get();

        return view('welcome', ['produits' => $produit]);
    }
}
