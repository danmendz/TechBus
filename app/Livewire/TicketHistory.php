<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Ticket;

class TicketHistory extends Component
{
    public $tickets;

    public function mount()
    {
        $userId = Auth::id();
        
        $this->tickets = Ticket::where('id_usuario', $userId)
                            ->orderBy('created_at', 'desc')
                            ->get();
    }

    public function render()
    {
        return view('livewire.ticket-history');
    }
}