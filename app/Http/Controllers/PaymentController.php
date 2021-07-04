<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\StripeService;
use Inertia\Inertia;

class PaymentController extends Controller
{
    protected $stripeService;

    public function __construct()
    {
        $this->stripeService = resolve('stripeService');
    }

    public function store(Request $request)
    {
        $carts = $request->user()->carts->load('product');

        $metadata = [
            'user_id' => auth()->id(),
            'cart_ids' => $carts->pluck('id')
        ];

        $stripeSession = $this->stripeService->generateCheckoutSession(
            $this->getProducts($carts),
            $request->user()->stripe_id,
            $metadata,
        );

        return response()->json(['id' => $stripeSession->id], 200);
    }

    public function success()
    {
        return Inertia::render('Payment/Success');
    }

    public function cancel()
    {
        return Inertia::render('Payment/Cancel');
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
