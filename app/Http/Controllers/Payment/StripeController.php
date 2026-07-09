<?php
namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Http\Controllers\PDFController;
use App\Models\Notificacion;
use App\Services\StripeService;
use App\Services\TicketService;
use App\Services\NotificationService;
use App\Services\PurchaseHistoryService;
use App\Services\SaveIncidenceNotificationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StripeController extends Controller
{
    protected $stripeService;
    protected $ticketService;
    protected $historyService;
    protected $notificationService;
    protected $pdfController;
    protected $incidenceNotificationService;
    protected $purchaseNotification;

    public function __construct(
        StripeService $stripeService,
        TicketService $ticketService,
        PurchaseHistoryService $historyService,
        NotificationService $notificationService,
        PDFController $pdfController,
        SaveIncidenceNotificationService $incidenceNotificationService,
    ) {
        $this->stripeService = $stripeService;
        $this->ticketService = $ticketService;
        $this->historyService = $historyService;
        $this->notificationService = $notificationService;
        $this->pdfController = $pdfController;
        $this->incidenceNotificationService = $incidenceNotificationService;
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
            $this->notificationService->sendNotifications($this->getUserName(), $this->getUserPhone(), $this->getNotificationData());

            // Guardar en historial
            $this->incidenceNotificationService->saveIncidence($this->getPurchaseNotificationId(), $ticketInsert->id_corrida);
    
            // Limpiar la sesión
            $this->stripeService->clearSession();
            
            return redirect()->route('my.tickets')->with('success', 'Pago procesado correctamente.');
        } else {
            return redirect()->route('stripe.cancel');
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

    protected function getPurchaseNotificationId(): int
    {
        $notificationId = (int) config('services.notification.purchase_notification');
        
        if ($notificationId === 0) {
            throw new \RuntimeException('El ID de notificación de compra no está configurado correctamente');
        }
        
        return $notificationId;
    }

    protected function getNotificationData()
    {
        $notificationData = Notificacion::find($this->getPurchaseNotificationId());
        
        if (!$notificationData) {
            throw new \RuntimeException("No se encontró la notificación con ID: {$this->getPurchaseNotificationId()}");
        }
        
        return $notificationData;
    }
    /**
     * Maneja la respuesta de cancelación de Stripe.
     */
    public function cancel()
    {
        return redirect()->route('my.tickets')->with('error', 'El pago no pudo procesarse correctamente.');
    }
}