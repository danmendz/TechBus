<?php

namespace App\Livewire;

use App\Services\WhatsappService;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class SendNotifications extends Component
{
    public $phoneNumbers = [
        '522216075444',
        '528444975248',
        '522212326923',
        '522226348266'
    ];

    public $selectedNumbers = [];
    public $message = '';
    protected $whatsappService;

    public function __construct()
    {
        $this->whatsappService = new WhatsappService();
    }

    public function toggleSelectAll()
    {
        // Si ya están todos seleccionados, desmarcarlos
        if (count($this->selectedNumbers) === count($this->phoneNumbers)) {
            $this->selectedNumbers = [];
        } else {
            // Si no, seleccionar todos
            $this->selectedNumbers = $this->phoneNumbers;
        }
    }

    public function sendMessages()
    {
        // Validar que se haya seleccionado al menos un número
        if (empty($this->selectedNumbers)) {
            session()->flash('error', 'Por favor, selecciona al menos un número de teléfono.');
            return;
        }

        // Enviar mensajes a los números seleccionados
        foreach ($this->selectedNumbers as $phoneNumber) {
            try {
                $this->whatsappService->sendMessage($phoneNumber);
            } catch (\Exception $e) {
                session()->flash('error', $e->getMessage());
            }
        }

        // Limpiar selección después de enviar los mensajes
        $this->selectedNumbers = [];
        session()->flash('message', 'Mensajes enviados correctamente.');
    }

    public function render()
    {
        return view('livewire.notifications.send-notifications');
    }
}
