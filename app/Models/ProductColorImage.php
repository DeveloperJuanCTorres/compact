<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class ProductColorImage extends Model
{
    use HasFactory;

    protected $fillable = ['product_id','color_id','image'];

    public function color()
    {
        return $this->belongsTo(Color::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
