<?php

if(!function_exists('setting')){
    function setting(){
        return App\Models\Setting::orderBy('id','desc')->first();
    }
}

if(!function_exists('country')){
    function country(){
        return App\Models\Country::orderBy('id','desc')->first();
    }
}

if(!function_exists('up')){
    function up(){
        return new App\Http\Controllers\Upload;
    }
}

if(!function_exists('image_validate')){
    function image_validate($ext=null){
        if($ext ===null){
            return 'required|image|mimes:png,jpg,jpeg';
        }else{
            return 'image|'.$ext;
        }
    }
}