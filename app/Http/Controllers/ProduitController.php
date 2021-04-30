<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProduitFormRequest;
use App\Mail\AjoutProduit;
use App\Models\Category;
use App\Models\Produit;
use App\Models\User;
use App\Notifications\NouveauProduit;
use Illuminate\Support\Facades\Mail;

class ProduitController extends Controller
{

    public function __construct()
        {
            $this->middleware(['auth', 'isAdmin'])->except(['show', 'index']);

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$produits=Produit::all();
        $produits = Produit::orderByDesc('id')->paginate(15); //pour pagigner recuperer 15,15

        return view('front-office/produits/index', ['produits' => $produits]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $produit = new Produit(); // juste pour envoyer un objet vide à la vue create à cause du partials

        return view('front-office.produits.create', compact('categories', 'produit'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(ProduitFormRequest $request)
    {
        //dd(date('d/m/y H:m:i', time()));

        $imageName = 'produit.png';
        if ($request->file('image')) {
            $imageName = time().'_'.$request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public/produits', $imageName);
        }
        //cette methode ne s'applique pas pour les API, cette methode fait un redirection vers le formulaire.
        /*   $request->validate([
               'designation' => 'required | min:5|max:50|unique:produits',
               'prix' => 'required|numeric|between:1000,1000000',
               'quantite' => 'required|numeric|between:5,5000',
               'description' => 'nullable|max:255',
               'category_id' => 'required|numeric', // "category_id"=>"required|numeric|exists:category",
           ]);*/
        //pour les API voici comment valider les donner, en utilisant la facade validator
        /*
        validator([

        ]);*/

        //dd($request->all()); // cette requête    affiche toute la reque
        $produit = Produit::create([
          'designation' => $request->designation,
          'prix' => $request->prix,
          'category_id' => $request->category_id,
          'quantite' => $request->quantite,
          'description' => $request->description,
          'image' => $imageName,
      ]);
      $user=User::first();

      Mail::to($user)->send(new AjoutProduit($produit));

        return redirect()->route('produits.show', $produit)->with('statut', 'Votre nouveau produit a été bien ajouté !');
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Produit $produit) // on fait un binding du modèle directement au lieu de faire une requête
    {
        return view('front-office.produits.show', compact('produit'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Produit $produit)
    {
        $categories = Category::all();

        return view('front-office.produits.edit', ['produit' => $produit, 'categories' => $categories]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(ProduitFormRequest $request, $id)
    {
        $produits=Produit::where('id', $id)->update([
            'designation' => $request->designation,
            'prix' => $request->prix,
            'quantite' => $request->quantite,
            'description' => $request->description,
            'category_id' => $request->category_id,
        ]);


        $user=User::first();
        $produit=Produit::where('id', $id)->first();
        //dd($produit);

      $user->notify(new NouveauProduit($produit));
        return redirect()->route('produits.show', $id)->with('statut', 'Votre produit a bien été modifié !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Produit::destroy($id);

        return redirect()->route('produits.index')->with('statut', 'Votre produit à bien été supprimé !');
    }
}
