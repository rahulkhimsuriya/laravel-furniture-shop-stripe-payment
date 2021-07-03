<?php


namespace App\Services;

use Stripe\Stripe;
use Stripe\Checkout\Session as StripeSsession;
use Stripe\Customer;

class StripeService
{
	/**
	 * Setup Stripe
	 */
	public function __construct()
	{
		Stripe::setApiKey(config('services.stripe.secret'));
	}

	/**
	 * Create Stripe Customer
	 */
	public function createCustomer(array $user)
	{
		return Customer::create([
			'name' => $user['name'],
			'email' => $user['email']
		]);
	}

	/**
	 * Generate Checkout Sesstion
	 */
	public function generateCheckoutSession(array $items, $customerId = null)
	{
		return StripeSsession::create([
			'customer' => $customerId,
			'payment_method_types' => ['card'],
			'line_items' => $items,
			'mode' => 'payment',
			'success_url' => route('payments.success'),
			'cancel_url' => route('payments.cancel'),
		]);
	}
}
