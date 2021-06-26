<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'image', 'price'];

    protected $appends = ['image_url'];

    public function getImageUrlAttribute()
    {
        return asset("/storage/product_images/{$this->image}");
    }
}
