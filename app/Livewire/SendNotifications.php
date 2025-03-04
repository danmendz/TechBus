<?php
namespace App\Livewire;

use App\Mail\NotificationEmail;
use App\Models\Notificacion;
use App\Models\User;
use App\Services\WhatsappService;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class SendNotifications extends Component
{
    public $users = []; // Para almacenar usuarios desde la DB
    public $selectedNumbers = [];
    public $failedNumbers = [];
    public $selectedFailedNumbers = [];
    public $message = '';
    protected $whatsappService;

    public $notifications = [];
    public $selectedNotificationId;
    public $notificationForm = [
        'estatus_notificacion' => '',
        'motivo' => '',
        'imagen' => '',
    ];

    public function mount()
    {
        $this->users = User::select('id', 'name', 'surnames', 'phone', 'email')->get()->toArray();
        $this->notifications = Notificacion::all();
    }

    public function __construct()
    {
        $this->whatsappService = new WhatsappService();
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

    // Se ejecuta cuando cambia el select
    public function loadNotificationData()
    {
        if ($this->selectedNotificationId) {
            $notification = Notificacion::find($this->selectedNotificationId);
            if ($notification) {
                $this->notificationForm = [
                    'estatus_notificacion' => $notification->estatus_notificacion,
                    'motivo' => $notification->motivo,
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
            'motivo' => '',
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

                    $parameters = [
                        (string) $user['name'],
                        'Ciudad de Puebla',
                        'Ciudad de México',
                        '2025-01-01',
                        '17:00',
                        $this->notificationForm['estatus_notificacion'],
                        $this->notificationForm['motivo']
                    ];

                    $image = $this->notificationForm['imagen'];

                    $this->whatsappService->sendMessage($user['phone'], $templateName, $parameters, $image, $languageCode);
                    session()->flash('message', 'Mensajes enviados correctamente.');

                } catch (\Exception $e) {
                    $this->failedNumbers[] = $user['id'];
                    session()->flash('error', "Error enviando mensaje a {$user['phone']}: " . $e->getMessage());
                }
            }
        }

        $this->selectedNumbers = [];
    }

    public function sendMessagesEmail()
    {
        if (empty($this->selectedFailedNumbers)) {
            session()->flash('error', 'Por favor, selecciona al menos un usuario fallido.');
            return;
        }

        $emails = $this->getEmailsFromUserIds($this->selectedFailedNumbers);

        foreach ($emails as $email) {
            $this->sendEmailNotification($email);
        }

        session()->flash('message', 'Correos electrónicos enviados correctamente.');
    }

    protected function getEmailsFromUserIds($userIds)
    {
        return User::whereIn('id', $userIds)->pluck('email')->toArray();
    }

    protected function sendEmailNotification($email)
    {
        $messageBody = "Este es un mensaje de prueba para los usuarios.";

        if (!empty($email)) {
            Mail::to('admin@miempresa.com')
                ->bcc($email)
                ->send(new NotificationEmail('Usuario', $messageBody));
        }
    }

    public function render()
    {
        return view('livewire.notifications.send-notifications', [
            'users' => $this->users,
        ]);
    }
}
