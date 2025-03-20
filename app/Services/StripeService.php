<?php
namespace App\Services;

use App\Models\Payment;
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

    /**
     * Valida los datos de la sesión.
     *
     * @return bool
     */
    public function validateSessionData()
    {
        return Session::has('product_name') && Session::has('quantity') && Session::has('price');
    }

    /**
     * Guarda el pago en la base de datos.
     *
     * @param \Stripe\Checkout\Session $session
     * @return Payment
     */
    public function savePayment($session)
    {
        $payment = Payment::create([
            'payment_id' => $session->id,
            'product_name' => Session::get('product_name'),
            'quantity' => Session::get('quantity'),
            'amount' => Session::get('price'),
            'currency' => $session->currency,
            'payer_name' => $session->customer_details->name,
            'payer_email' => $session->customer_details->email,
            'payment_status' => $session->status,
            'payment_method' => "Stripe",
        ]);
        // Session::put('payment_id', $payment->id);

        return $payment;
    }

    /**
     * Limpia los datos de la sesión.
     */
    public function clearSession()
    {
        Session::forget([
            'payment_id', 'product_name','quantity', 'price','corrida_id','corrida_details', 'precios_detallados', 'resumen_boletos'
        ]);
    }
}