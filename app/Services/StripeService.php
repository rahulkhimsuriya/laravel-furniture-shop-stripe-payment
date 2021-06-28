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

	public function generateCheckoutSession(array $items, array $paymetMethodTypes =  ['card'], $mode = 'payment')
	{
		return StripeSsession::create([
			'payment_method_types' => $paymetMethodTypes,
			'line_items' => $items,
			'mode' => $mode,
			'success_url' => "/paymets?success",
			'cancel_url' => "/paymets?success",
		]);
	}
}
