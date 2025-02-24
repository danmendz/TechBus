<?php

namespace App\Services;

use Stripe\StripeClient;
use Illuminate\Support\Facades\Session;

class StripeService
{
    protected $stripe;

    public function __construct()
    {
        $this->stripe = new StripeClient(config('stripe.stripe_sk'));
    }

    /**
     * Crea una sesión de pago en Stripe.
     *
     * @param array $data
     * @return \Stripe\Checkout\Session
     */
    public function createCheckoutSession(array $data)
    {
        $session = $this->stripe->checkout->sessions->create([
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => 'mxn',
                        'product_data' => [
                            'name' => $data['product_name'],
                        ],
                        'unit_amount' => $data['price'] * 100,
                    ],
                    'quantity' => $data['quantity'],
                ],
            ],
            'mode' => 'payment',
            'success_url' => route('stripe.success') . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('stripe.cancel'),
        ]);

        return $session;
    }

    /**
     * Recupera los detalles de una sesión de pago.
     *
     * @param string $sessionId
     * @return \Stripe\Checkout\Session
     */
    public function retrieveCheckoutSession(string $sessionId)
    {
        return $this->stripe->checkout->sessions->retrieve($sessionId);
    }
}