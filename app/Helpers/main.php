<?php
if (!function_exists('nb_produit')) {
    function nb_produit($nb)
    {
        if ($nb>1) {
            return $nb." produits";
            # code...
        }
        else{
        return $nb." produit";
    }
    }
}


    if (!function_exists('separateur_cfa')) {
        function separateur_cfa($nb)
        {
           return number_format($nb,2,',',' ')." FCFA";
        }
    # code...
}
