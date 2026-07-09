<?php

namespace App\Livewire;

use App\Models\Corrida;
use App\Models\Horario;
use App\Models\PurchaseHistory;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class UserStatsDashboard extends Component
{
    public $upcomingTripsCount;
    public $completedTripsCount;
    public $favoriteRoutesCount;
    public $upcomingTrips = [];

    public function mount()
    {
        $userId = Auth::user()->id;
        
        // Contar viajes próximos (fecha de corrida en el futuro)
        $this->upcomingTripsCount = PurchaseHistory::where('id_usuario', $userId)
            ->whereHas('corrida', function($query) {
                $query->where('fecha', '>=', Carbon::now());
            })
            ->count();

        // Contar viajes completados (fecha de corrida en el pasado)
        $this->completedTripsCount = PurchaseHistory::where('id_usuario', $userId)
            ->whereHas('corrida', function($query) {
                $query->where('fecha', '<', Carbon::now());
            })
            ->count();

        // Contar rutas favoritas 
        $this->favoriteRoutesCount = PurchaseHistory::where('id_usuario', $userId)
            ->select('id_corrida')
            ->groupBy('id_corrida')
            ->havingRaw('COUNT(id_corrida) >= 1')
            ->count();

        // Próximos viajes con información detallada
        $this->upcomingTrips = PurchaseHistory::with([
            'corrida.horario', 
            'corrida.ruta.origen', 
            'corrida.ruta.destino'
        ])
        ->where('id_usuario', $userId)
        ->whereHas('corrida.horario', function($query) {
            $query->where('hora', '>=', Carbon::now()->format('H:i:s'));
        })
        ->whereHas('corrida', function($query) {
            $query->where('fecha', '>=', Carbon::today());
        })
        ->join('corridas', 'purchase_history.id_corrida', '=', 'corridas.id')
        ->join('horarios', 'corridas.id_horario', '=', 'horarios.id')
        ->orderBy('corridas.fecha', 'asc')
        ->orderBy('horarios.hora', 'asc')
        ->take(3)
        ->get()
        ->map(function($purchase) {
            return [
                'id' => $purchase->id,
                'fecha' => $purchase->corrida->fecha,
                'hora_salida' => $purchase->corrida->horario->hora,
                'origen' => $purchase->corrida->ruta->origen->nombre,
                'destino' => $purchase->corrida->ruta->destino->nombre,
                'corrida_id' => $purchase->corrida->id,
                'ticket_id' => $purchase->id_ticket
            ];
        })
        ->toArray();
    }

    public function render()
    {
        return view('livewire.user-stats-dashboard');
    }
}
