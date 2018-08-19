<?php

namespace App\Events\Crud;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use App\Models\BaseModel;

abstract class Crud
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $action;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(BaseModel $model)
    {
        $table_name = $model->getClassName();
        $table = with(new $table_name)->getTable();
        $primary_key = $model->primaryKey;
        $model_arr = $model->toArray();
        $target_id = $model_arr["$primary_key"];


        $model->target_id = $target_id;
        $model->table = $table;

        $this->model = $model;
    }

    public function setAction($action)
    {
        $this->model->action = $action;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
