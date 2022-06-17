<?php

namespace App\Events\Dashboard;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class DeleteEvent2
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    // event(new DeleteEvent($this->models,$this->cond,$this->columns,$ids));
    public $related_ids,$column,$models,$cond;
    public function __construct($models,$cond,$column,$related_ids)
    {
        $this->related_ids=$related_ids;
        $this->column=$column;
        $this->models=$models;
        $this->cond=$cond;
    }

    public function broadcastOn()
    {
       // return new PrivateChannel('channel-name');
    }
}
