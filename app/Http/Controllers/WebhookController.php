<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Stripe\PaymentIntent;

class WebhookController extends Controller
{
    protected $stripeService;

    public function __construct()
    {
        $this->stripeService = resolve('stripeService');
    }

    public function handle(Request $request)
    {
        $payload = $request->all();

        try {
            if ($payload['type'] == 'checkout.session.completed') {
                $this->handleCheckoutSessionCompleted($payload);
            }
        } catch (\Throwable $th) {
            throw new \Exception($th->getMessage(), $th->getCode());
        }
    }

    public function handleCheckoutSessionCompleted($payload)
    {
        $paymentIntentId = $payload['data']['object']['payment_intent'];
        $paymentIntent = PaymentIntent::retrieve($paymentIntentId);

        DB::transaction(function () use ($payload, $paymentIntent) {
            $paymentIntentCharge = $paymentIntent['charges']['data'][0];
            $metadata = $payload['data']['object']['metadata'];

            $order = Order::create([
                'user_id' => $metadata['user_id'],
                'name' => $paymentIntentCharge['billing_details']['name'],
                'email' => $paymentIntentCharge['billing_details']['email'],
                'payment_intent_id' => $paymentIntent['id'],
                'currency' => $paymentIntentCharge['currency'],
                'amount' => $paymentIntent['amount_received'],
                'card_brand' => $paymentIntentCharge['payment_method_details']['card']['brand'],
                'card_last4' => $paymentIntentCharge['payment_method_details']['card']['last4'],
                'receipt_url' => $paymentIntentCharge['receipt_url'],
                'status' => $paymentIntent['status'],
            ]);

            $cartIds = json_decode($metadata['cart_ids']);

            $carts = tap(
                Cart::with(['product'])
                    ->whereIn('id', $cartIds)
                    ->get(),
                function ($carts) {
                    $carts->each->delete();
                }
            );

            $products = $carts->map(function ($cart) {
                return [
                    'product_id' => $cart->product_id,
                    'price' => $cart->product->price,
                    'quantity' => $cart->quantity,
                ];
            })->toArray();

            $order->orderDetails()->createMany($products);
        });
    }
}
