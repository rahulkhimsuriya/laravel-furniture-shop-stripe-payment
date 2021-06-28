<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\StripeService;
use Inertia\Inertia;

class PaymentController extends Controller
{
    protected $stripeService;

    public function __construct(StripeService $stripeService)
    {
        $this->stripeService = $stripeService;
    }

    public function store(Request $request)
    {
        $carts = $request->user()->carts->load('product');

        $items = $carts->map(function ($cart) {
            return [
                'price_data' => [
                    'currency' => 'inr',
                    'unit_amount' => $cart->product->price,
                    'product_data' => [
                        'name' =>  $cart->product->name,
                        'images' => [$cart->product->image_url],
                    ],
                ],
                'quantity' => $cart->quantity,
            ];
        })->toArray();

        $stripeSession = $this->stripeService->generateCheckoutSession($items);

        return response()->json(['id' => $stripeSession->id]);
    }
}
