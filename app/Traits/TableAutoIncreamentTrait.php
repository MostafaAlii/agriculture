<?php

namespace App\Traits;

use Illuminate\Support\Facades\DB;

Trait  TableAutoIncreamentTrait
{
     function refreshTable($tabel){

      $max = DB::table($tabel)->max('id') + 1; 
      DB::statement("ALTER TABLE ".$tabel." AUTO_INCREMENT =  $max");
    }

    
}
