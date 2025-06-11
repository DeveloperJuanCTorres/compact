<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'taxonomy_id',
        'brand_id',
        'name',
        'description',
        'information',
        'price',
        'images',
        'unidad_medida',
        'stock',
        'slug'  
    ];

    public function taxonomy()
    {
        return $this->belongsTo(Taxonomy::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
