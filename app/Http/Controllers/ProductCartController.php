<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductCartController extends Controller
{
    public function store(Request $request, Product $product)
    {
        $request->validate(['quantity' => ['required', 'min:1']]);

        $product->addToCart($request->user(), $request->quantity);

        $request->session()->flash('flash.banner', 'Yay product added in cart successfully.');
        $request->session()->flash('flash.bannerStyle', 'success');

        return redirect()->route('dashboard');
    }
}
