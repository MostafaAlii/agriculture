<?php

if(!function_exists('setting')){
    function setting(){
        return App\Models\Setting::orderBy('id','desc')->first();
    }
}

if(!function_exists('image_validate')){
    function image_validate($ext=null){
        if($ext ===null){
            return 'image|mimes:png,jpg,jpeg,bmp,jif';
        }else{
            return 'image|'.$ext;
        }
    }
}