<?php

namespace App\Listeners;

use App\Events\Dashboard\DeleteEvent2;

class DeleteEventListener2
{
 
    public function __construct()
    {
        //
    }

    public function handle(DeleteEvent2 $event)
    {
       
       // dd($event->related_ids[1]);
        for($i=0;$i<sizeof($event->models);$i++){
            //dd($event->related_ids[$i][0]);
           // $event->models[$i]::$event->cond[$i]($event->column[$i], $event->related_ids[$i])->delete();//softdelete

            if($event->cond[$i]=='WhereIn'){
                 $event->models[$i]::WhereIn($event->column[$i],$event->related_ids[$i][0])->delete();//softdelete
            }else{
                $event->models[$i]::Where($event->column[$i], $event->related_ids[$i])->delete();//softdelete
            }

        //    Product:: whereIn ('id',$event->related_ids[$i][0])->delete();
        //    Category:: where('parent_id',$event->related_ids[1])->delete();
        }
    }
}
