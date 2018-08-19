<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\History;

class CrudEventSubscriber
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

    public function onCrud($event)
    {
        $history = new History;
        $event = (array)$event;
        //$target_id = $event[$id_key];
        $event = (object)$event;
        $notes = 'lol';

        //$history->table = 'invoices';
        $history->table = $event->model->table;
        $history->user_id = \Auth::user()->id;
        $history->notes = $notes;
        $history->action = $event->model->action;
        $history->target_id = $event->model->target_id;
        $history->save();
    }

    public function subscribe($events)
    {
        $events->listen('App\Events\Crud\Created', 'App\Listeners\CrudEventSubscriber@onCrud');
        $events->listen('App\Events\Crud\Updated', 'App\Listeners\CrudEventSubscriber@onCrud');
        $events->listen('App\Events\Crud\Deleted', 'App\Listeners\CrudEventSubscriber@onCrud');
    }
}
