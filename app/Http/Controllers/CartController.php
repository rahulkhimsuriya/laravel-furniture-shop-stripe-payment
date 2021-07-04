<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CartController extends Controller
{
    public function index(Request $request)
    {
        $carts = $request->user()->carts->load('product');

        $totalAmount = $carts->map(function ($cart) {
            return ($cart->quantity * $cart->product->price);
        })->sum();

        return Inertia::render('Cart/Index', [
            'totalAmount' => number_format(($totalAmount / 100), 2),
            'carts' => $carts->map(function ($cart) {
                return [
                    'cart_id' => $cart->id,
                    'quantity' => $cart->quantity,
                    'total_amount' => number_format($cart->total_amount, 2),
                    'product' => [
                        'product_id' => $cart->product->id,
                        'name' => $cart->product->name,
                        'price' => number_format($cart->product->price / 100, 2),
                        'image_url' => $cart->product->image_url,
                    ]
                ];
            })
        ]);
    }

    public function destroy(Request $request, Cart $cart)
    {
        $cart->delete();

        $request->session()->flash('flash.banner', 'Yay product removed from the cart successfully.');
        $request->session()->flash('flash.bannerStyle', 'success');

        return redirect()->back();
    }
}
