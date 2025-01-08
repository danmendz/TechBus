<?php

namespace App\Http\Controllers\Payment;
use App\Http\Controllers\Controller;

use App\Models\Payment;
use Illuminate\Http\Request;

class StripeController extends Controller
{

    /**
     * Store a newly created resource in storage.
     */
    public function stripe(Request $request)
    {
        $stripe = new \Stripe\StripeClient(config('stripe.stripe_sk'));

        $response = $stripe->checkout->sessions->create([
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => 'mxn',
                        'product_data' => [
                            'name' => $request->product_name,
                        ],
                        'unit_amount' => $request->price*100,
                    ],
                    'quantity' => $request->quantity,
                ],
            ],
            'mode' => 'payment',
            'success_url' => route('success').'?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('cancel'),
        ]);
        // dd($response);

        if (isset($response->id) && $response->id != '') {
            session()->put('product_name', $request->product_name);
            session()->put('quantity', $request->quantity);
            session()->put('price', $request->price);
            return redirect($response->url);

        } else {
            return redirect()->route('cancel');
        }
    }

    /**
     * Display success resource.
     */
    public function success(Request $request)
    {
        // return "Success";

        if (isset($request->session_id)) {
            
            $stripe = new \Stripe\StripeClient(config('stripe.stripe_sk'));
            $response = $stripe->checkout->sessions->retrieve($request->session_id);

            // dd($response);

            $payment = new Payment();
            $payment->payment_id = $response->id;
            $payment->product_name = session()->get('product_name');
            $payment->quantity = session()->get('quantity');
            $payment->amount = session()->get('price');
            $payment->currency = $response->currency;
            $payment->payer_name = $response->customer_details->name;
            $payment->payer_email = $response->customer_details->email;
            $payment->payment_status = $response->status;
            $payment->payment_method = "Stripe";
            $payment->save();

            return "El pago fue completado";

            session()->forget('product_name');
            session()->forget('quantity');
            session()->forget('price');
        } else {
            return redirect()->route('cancel');
        }
    }

    /**
     * Display cancel resource.
     */
    public function cancel()
    {
        return "cancel";
    }
}
