<?php

use App\Http\Controllers\FormationController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\ProduitController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',[MainController::class,'accueil'])->name('accueil');
Route::get('ajouter-produit',[FormationController::class,'ajouterProduit']);
Route::get('ajouter-produit-2',[FormationController::class,'ajouterProduit2']);
Route::get('index',[FormationController::class,'index']);
Route::get('maj',[FormationController::class,'updateProduit']);
Route::resource('produits', ProduitController::class);

