<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    public $fillable = ['designation', 'prix', 'description', 'quantite', 'category_id', 'image'];
    use HasFactory;

    public function Category()
    {
        return $this->belongsTo(Category::class);
    }

    //relation plusieurs à plusieurs
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
