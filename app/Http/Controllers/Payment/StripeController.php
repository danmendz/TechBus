<?php
namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Services\StripeService;
use App\Services\TicketService;
use App\Services\NotificationService;
use App\Services\PurchaseHistoryService;
use Illuminate\Http\Request;

class StripeController extends Controller
{
    protected $stripeService;
    protected $ticketService;
    protected $historyService;
    protected $notificationService;

    public function __construct(
        StripeService $stripeService,
        TicketService $ticketService,
        PurchaseHistoryService $historyService,
        NotificationService $notificationService
    ) {
        $this->stripeService = $stripeService;
        $this->ticketService = $ticketService;
        $this->historyService = $historyService;
        $this->notificationService = $notificationService;
    }

    /**
     * Maneja la respuesta de éxito de Stripe.
     */
    public function success(Request $request)
    {
        if (!$request->session_id) {
            return redirect()->route('stripe.cancel')->with('error', 'Sesión no encontrada.');
        }

        // Recuperar la sesión de Stripe
        $session = $this->stripeService->retrieveCheckoutSession($request->session_id);

        // Validar datos de la sesión
        if (!$this->stripeService->validateSessionData()) {
            return redirect()->route('stripe.cancel')->with('error', 'Datos de pago no encontrados.');
        }

        // Guardar el pago
        $payment = $this->stripeService->savePayment($session);

        // Guardar el ticket
        $ticket = $this->ticketService->saveTicket();

        
        if ($payment && $ticket) {
            // Guardar en el historial
            $ticket = $this->historyService->saveHistory($payment->id, $ticket->id);

            // Enviar notificaciones
            $this->notificationService->sendNotifications();
    
            // Limpiar la sesión
            $this->stripeService->clearSession();
            
            return redirect()->route('dashboard')->with('success', 'Pago procesado correctamente.');
        } else {
            return redirect()->route('stripe.cancel')->with('error', 'Los datos no se guardaron correctamente.');
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