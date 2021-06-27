<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        return Inertia::render('Product/Index', [
            'products' => Product::all()->map(function ($product) {
                return [
                    'product_id' => $product->id,
                    'name' => $product->name,
                    'price' => round($product->price / 100, 2),
                    'image_url' => $product->image_url,
                ];
            })
        ]);
    }
}
