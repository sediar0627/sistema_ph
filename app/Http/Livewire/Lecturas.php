<?php

namespace App\Http\Livewire;

use App\Models\Cliente;
use App\Models\LecturaPiscina;
use App\Models\Piscina;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Lecturas extends Component
{
    public Cliente $cliente;

    public $lecturas = [];
    public $labels = [];

    public function mount()
    {
        $this->cliente = Cliente::where("user_id", Auth::user()->id)->first();
    }

    public function render()
    {

        $this->labels = [];
        $this->lecturas = [];

        $piscinas = $this->cliente->piscinas;

        foreach ($piscinas as $piscina) {

            $lecturas_coleccion = LecturaPiscina::where("piscina_id", $piscina->id)
                ->orderByDesc("id")
                ->take(10)
                ->get();

            $labels = $lecturas_coleccion->pluck('created_at')
                ->map(function($fecha){
                    return $fecha->format('Y-m-d H:i:s');
                })->toArray();

            $lecturas = $lecturas_coleccion
                ->pluck('lectura')
                ->toArray();

            if (count($lecturas) > 0) {
                $this->labels[$piscina->nombre] = $labels;
                $this->lecturas[$piscina->nombre] = json_encode($lecturas);
            }
        }

        return view('livewire.lecturas');
    }
}
