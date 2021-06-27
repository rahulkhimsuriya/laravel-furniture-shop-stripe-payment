<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['name', 'image', 'price'];

    protected $appends = ['image_url'];

    public function getImageUrlAttribute()
    {
        return asset("/storage/product_images/{$this->image}");
    }

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    public function addToCart($user = null, $quantity = 1)
    {
        $user = $user  ?? auth()->user();

        return $this->carts()->create([
            'user_id' => $user->id,
            '$quantity' => $quantity
        ]);
    }
}
