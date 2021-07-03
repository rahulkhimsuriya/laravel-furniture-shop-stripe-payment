<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\StripeService;

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

        $items = $this->getProducts($carts);

        $stripeSession = $this->stripeService->generateCheckoutSession($items);

        return response()->json(['id' => $stripeSession->id], 200);
    }

    public function success()
    {
        return response()->json(['sucess' => true, 'message' => 'payment sucessfull.']);
    }

    public function cancel()
    {
        return response()->json(['sucess' => false, 'message' => 'payment failed.']);
    }

    private function getProducts($carts)
    {
        return $carts->map(function ($cart) {
            return [
                'price_data' => [
                    'currency' => 'inr',
                    'unit_amount' => $cart->product->price * $cart->quantity,
                    'product_data' => [
                        'name' => $cart->product->name,
                        'images' => [$cart->product->image_url],
                    ],
                ],
                'quantity' => $cart->quantity,
            ];
        })->toArray();
    }
}
