@component('mail::message')
# Modification sur openShop


## Modification d'un produit sur votre superbe plateforme OpenShop


### Vous trouverez ci-dessous les informations sur le  produit modifidier
<p style="color: blue; font-size:24px;">Designation : <strong>{{ $produit->designation }}</strong></p>
<p style="color: red; font-size:24px;">Prix : <strong>{{ separateur_cfa($produit->prix) }}</strong></p>
<p style="color: rgb(17, 141, 79); font-size:24px;">Categorie  : <strong>{{ $produit->Category->libelle }}</strong></p>

<p style="color: green; font-size:24px;">Pour commander ce produit cliquez sur le bouton ci-dessous</p>

@component('mail::button', ['url' => route('produits.show', $produit)])
Commander ce produit
@endcomponent

Merci d'avoir choisi openShop pour votre shopping,<br><br><br>
{{ config('app.name') }}
@endcomponent
