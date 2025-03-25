<?php
namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Http\Controllers\PDFController;
use App\Services\StripeService;
use App\Services\TicketService;
use App\Services\NotificationService;
use App\Services\PurchaseHistoryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StripeController extends Controller
{
    protected $stripeService;
    protected $ticketService;
    protected $historyService;
    protected $notificationService;
    protected $pdfController;

    public function __construct(
        StripeService $stripeService,
        TicketService $ticketService,
        PurchaseHistoryService $historyService,
        NotificationService $notificationService,
        PDFController $pdfController,
    ) {
        $this->stripeService = $stripeService;
        $this->ticketService = $ticketService;
        $this->historyService = $historyService;
        $this->notificationService = $notificationService;
        $this->pdfController = $pdfController;
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
        $paymentInsert = $this->stripeService->savePayment($session);

        // Guardar el ticket
        $ticketInsert = $this->ticketService->saveTicket();

        
        if ($paymentInsert && $ticketInsert) {
            // Guardar en el historial
            $this->historyService->saveHistory($paymentInsert->id, $ticketInsert->id, $ticketInsert->id_corrida);

            // Llamar al método generatePdf del PDFController
            $this->pdfController->generatePdf($ticketInsert);

            // Enviar notificaciones
            $this->notificationService->sendNotifications($this->getUserName(), $this->getUserPhone());
    
            // Limpiar la sesión
            $this->stripeService->clearSession();
            
            return redirect()->route('dashboard')->with('success', 'Pago procesado correctamente.');
        } else {
            return redirect()->route('stripe.cancel')->with('error', 'Los datos no se guardaron correctamente.');
        }
    }

    protected function getUserName() {
        $userName = Auth::user()->name;
        return $userName;
    }

    protected function getUserPhone() {
        $userPhone = Auth::user()->phone;
        return $userPhone;
    }

    /**
     * Maneja la respuesta de cancelación de Stripe.
     */
    public function cancel()
    {
        return "cancel";
    }
}