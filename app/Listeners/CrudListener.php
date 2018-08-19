<?php

namespace App\Listeners;

use App\Events\Crud;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CrudListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  Crud  $event
     * @return void
     */
    public function handle(Crud $event)
    {
        //
    }
}
