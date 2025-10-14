<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Subtaxonomy extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'taxonomy_id'];

    public function taxonomy()
    {
        return $this->belongsTo(Taxonomy::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function productsInStock()
    {
        return $this->hasMany(Product::class, 'subtaxonomy_id')->where('stock', '>', 0);
    }
}
