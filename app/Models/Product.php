<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function type()
    {
        return $this->belongsTo(Type::class,'type_id','id');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function productPhotos()
    {
        return $this->hasMany(ProductPhoto::class,'product_id','id');
    }

    public function favorite()
    {
        return $this->hasMany(Favorite::class, 'product_id', 'id');
    }

    public function cart()
    {
        return $this->hasMany(Cart::class, 'Product_id');
    }
}
