<?php

namespace App\Http\Controllers\Payment;
use App\Http\Controllers\Controller;

use App\Models\Payment;
use App\Services\StripeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class StripeController extends Controller
{
    protected $stripeService;

    public function __construct(StripeService $stripeService)
    {
        $this->stripeService = $stripeService;
    }

    /**
     * Maneja la respuesta de éxito de Stripe.
     */
    public function success(Request $request)
    {
        if ($request->session_id) {
            $session = $this->stripeService->retrieveCheckoutSession($request->session_id);
            // Log::info('Sesión recuperada:', (array) $session);
            // Log::info('Datos en la sesión:', session()->all());

            if (!session()->has('product_name') || !session()->has('quantity') || !session()->has('price')) {
                // Log::error('Datos de pago no encontrados en la sesión.');
                return redirect()->route('stripe.cancel')->with('error', 'Datos de pago no encontrados.');
            }

            $payment = new Payment();
            $payment->payment_id = $session->id;
            $payment->product_name = session('product_name');
            $payment->quantity = session('quantity');
            $payment->amount = session('price');
            $payment->currency = $session->currency;
            $payment->payer_name = $session->customer_details->name;
            $payment->payer_email = $session->customer_details->email;
            $payment->payment_status = $session->status;
            $payment->payment_method = "Stripe";
            $payment->save();

            // Log::info('Registro creado:', (array) $payment);

            session()->forget(['product_name', 'quantity', 'price']);
            return "El pago fue completado";
        } else {
            return redirect()->route('stripe.cancel');
        }
    }

    /**
     * Maneja la respuesta de cancelación de Stripe.
     */
    public function cancel()
    {
        return "cancel";
    }
}