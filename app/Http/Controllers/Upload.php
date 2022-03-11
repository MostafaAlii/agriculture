<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DebugBar\Storage;

class Upload extends Controller
{
    static public function upload($new_name=null , $path,$request){

          $new_name = $new_name===null?time():$new_name;

    }
}