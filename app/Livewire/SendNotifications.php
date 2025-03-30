<?php
namespace App\Livewire;

use App\Mail\IncidenceNotificationEmail;
use Filament\Notifications\Notification;
use App\Mail\NotificationEmail;
use App\Models\Notificacion;
use App\Models\Corrida;
use App\Models\PurchaseHistory;
use App\Models\User;
use App\Services\SaveIncidenceNotificationService;
use App\Services\WhatsappService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class SendNotifications extends Component
{
    public $users = [];
    public $selectedNumbers = [];
    public $failedNumbers = [];
    public $selectedFailedNumbers = [];
    public $message = '';

    // Services
    protected $whatsappService;
    protected $incidenceNotificationService;

    public $notifications = [];
    public $selectedNotificationId;
    public $notificationForm = [
        'estatus_notificacion' => '',
        'descripcion' => '',
        'imagen' => '',
    ];

    // Nuevas propiedades para corridas
    public $corridas = [];
    public $selectedCorridaId;
    public $selectedCorridaData;
    public $notificationMessage;

    public function mount()
    {
        $this->corridas = Corrida::with(['ruta.origen', 'ruta.destino', 'horario'])->orderBy('fecha', 'desc')->get();
        $this->notifications = Notificacion::all();
    }

    public function __construct()
    {
        $this->whatsappService = new WhatsappService();
        $this->incidenceNotificationService = new SaveIncidenceNotificationService();
    }

    // Método para cargar usuarios basados en la corrida seleccionada
    public function loadUsersByCorrida()
    {
        if ($this->selectedCorridaId) {
            $this->selectedCorridaData = Corrida::with(['ruta.origen', 'ruta.destino', 'horario'])
                ->find($this->selectedCorridaId);

            $userIds = PurchaseHistory::where('id_corrida', $this->selectedCorridaId)
                ->pluck('id_usuario')
                ->unique()
                ->toArray();

            $this->users = User::whereIn('id', $userIds)
                ->select('id', 'name', 'surnames', 'phone', 'email')
                ->get()
                ->toArray();
        } else {
            $this->users = [];
        }

        // Limpiar selecciones al cambiar de corrida
        $this->selectedNumbers = [];
        $this->selectedFailedNumbers = [];
        $this->failedNumbers = [];
    }

    public function toggleSelectAll()
    {
        if (count($this->selectedNumbers) === count($this->users)) {
            $this->selectedNumbers = [];
        } else {
            $this->selectedNumbers = array_column($this->users, 'phone');
        }
    }

    public function toggleSelectAllFailed()
    {
        if (count($this->selectedFailedNumbers) === count($this->failedNumbers)) {
            $this->selectedFailedNumbers = [];
        } else {
            $this->selectedFailedNumbers = $this->failedNumbers;
        }
    }

    public function loadNotificationData()
    {
        if ($this->selectedNotificationId) {
            $notification = Notificacion::find($this->selectedNotificationId);
            if ($notification) {
                $this->notificationForm = [
                    'estatus_notificacion' => $notification->estatus_notificacion,
                    'descripcion' => $notification->descripcion,
                    'imagen' => $notification->imagen,
                ];
            }
        } else {
            $this->resetForm();
        }
    }

    public function resetForm()
    {
        $this->notificationForm = [
            'estatus_notificacion' => '',
            'descripcion' => '',
            'imagen' => '',
        ];
    }

    public function sendMessagesWhatsapp()
    {
        if (empty($this->selectedNumbers)) {
            session()->flash('error', 'Por favor, selecciona al menos un número de teléfono.');
            return;
        }

        $this->failedNumbers = [];

        foreach ($this->users as $user) {
            if (in_array($user['phone'], $this->selectedNumbers)) {
                try {
                    $templateName = 'notificacion_de_incidencias';
                    $languageCode = 'es';

                    $formattedTime = $this->selectedCorridaData->horario->hora 
                    ? Carbon::parse($this->selectedCorridaData->horario->hora)->format('H:i') 
                    : 'Hora no disponible';

                    $parameters = [
                        (string) $user['name'],
                        $this->selectedCorridaData->ruta->origen->nombre ?? 'Ciudad de origen',
                        $this->selectedCorridaData->ruta->destino->nombre ?? 'Ciudad de destino',
                        $this->selectedCorridaData->fecha,
                        $formattedTime,
                        $this->notificationForm['estatus_notificacion'],
                        $this->notificationForm['descripcion']
                    ];

                    $image = $this->notificationForm['imagen'];

                    // Enviar notificaciónde Whatsapp
                    $this->whatsappService->sendMessage($user['phone'], $templateName, $parameters, $image, $languageCode);

                    // Guardar en el historial de incidencias
                    $this->incidenceNotificationService->saveIncidence($this->selectedNotificationId, $this->selectedCorridaId);

                    Notification::make()
                        ->title('Mensajes de Whatsapp enviados correctamente.')
                        ->success()
                        ->send();

                } catch (\Exception $e) {
                    $this->failedNumbers[] = $user['id'];
                    Notification::make()
                        ->title("Error al enviar mensajes de Whatsapp a {$user['name']} - {$user['phone']}")
                        ->danger()
                        ->send();
                    // session()->flash('error', "Error al enviar mensaje a "."{$user['name']}"." - "."{$user['phone']}");
                }
            }
        }

        $this->selectedNumbers = [];
    }

    public function sendMessagesEmail()
    {
        if (empty($this->selectedFailedNumbers)) {
            Notification::make()
                ->title('Error: No hay usuarios seleccionados')
                ->danger()
                ->send();
            return;
        }

        foreach ($this->selectedFailedNumbers as $userId) {
            $user = User::find($userId);
            if ($user && $user->email) {
                try {
                    $this->sendEmailNotification($user->email, $userId);
                    
                    Notification::make()
                        ->title("Email enviado a {$user->email}")
                        ->success()
                        ->send();
                } catch (\Exception $e) {
                    Log::error("Error enviando email: " . $e->getMessage());
                    
                    Notification::make()
                        ->title("Error al enviar email a {$user->email}")
                        ->danger()
                        ->send();
                }
            }
        }
    }

    protected function getEmailsFromUserIds($userIds)
    {
        return User::whereIn('id', $userIds)->pluck('email')->toArray();
    }

    // En tu Livewire component
    protected function sendEmailNotification($email, $userId)
    {
        if (empty($email)) {
            return false;
        }

        try {
            $user = User::findOrFail($userId);
            $corrida = $this->selectedCorridaData;

            Mail::to($email)->send(
                new IncidenceNotificationEmail(
                    $user,
                    $corrida,
                    $this->notificationForm
                )
            );

            return true;
        } catch (\Exception $e) {
            Log::error("Email send failed to {$email}: " . $e->getMessage());
            return false;
        }
    }

    public function render()
    {
        return view('livewire.notifications.send-notifications', [
            'users' => $this->users,
        ]);
    }
}