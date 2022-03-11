<?php
/**
 * Created by PhpStorm.
 * User: nana
 * Date: 3/9/2022
 * Time: 10:06 PM
 */

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