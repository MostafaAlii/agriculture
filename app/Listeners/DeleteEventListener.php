<?php

namespace App\Listeners;

use App\Events\Dashboard\DeleteEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class DeleteEventListener
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
     * @param  \App\Events\Dashboard\DeleteEvent  $event
     * @return void
     */
    public function handle(DeleteEvent $event)
    {
        //id,column names for each model,other models
        for($i=0;$i<sizeof($event->models);$i++){
            $event->models[$i]::where($event->column[$i], $event->id)->delete();//softdelete
        }
    }
}
