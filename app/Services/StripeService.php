<?php


namespace App\Services;

use Stripe\Stripe;
use Stripe\Checkout\Session as StripeSsession;

class StripeService
{
	public function __construct()
	{
		Stripe::setApiKey(config('services.stripe.secret'));
	}

	public function generateCheckoutSession(array $items)
	{
		return StripeSsession::create([
			'payment_method_types' => ['card'],
			'line_items' => $items,
			'mode' => 'payment',
			'success_url' => route('payments.sucess'),
			'cancel_url' => route('payments.cancel'),
		]);
	}
}
