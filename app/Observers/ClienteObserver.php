<?php

namespace App\Observers;

use App\Models\Cliente;
use Illuminate\Support\Str;

class ClienteObserver
{
    /**
     * Handle the Elemento "creating" event.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return void
     */
    public function creating(Cliente $cliente)
    {
        $uuid = Str::uuid();
        while (Cliente::where("uuid", $uuid)->count() > 0) {
            $uuid = Str::uuid();
        }
        $cliente->uuid = $uuid;
    }

    /**
     * Handle the Cliente "created" event.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return void
     */
    public function created(Cliente $cliente)
    {
        //
    }

    /**
     * Handle the Cliente "updated" event.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return void
     */
    public function updated(Cliente $cliente)
    {
        //
    }

    /**
     * Handle the Cliente "deleted" event.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return void
     */
    public function deleted(Cliente $cliente)
    {
        //
    }

    /**
     * Handle the Cliente "restored" event.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return void
     */
    public function restored(Cliente $cliente)
    {
        //
    }

    /**
     * Handle the Cliente "force deleted" event.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return void
     */
    public function forceDeleted(Cliente $cliente)
    {
        //
    }
}
