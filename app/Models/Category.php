<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function brands()
    {
      return  $this->hasMany(Brand::class);
    }

    public function product()
    {
      return $this->hasMany(Product::class);
    }
}
