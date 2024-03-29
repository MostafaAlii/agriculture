<?php
namespace App\Traits;
trait Keywords
{
    public function handel_keyword($keyword) {

       //replace any \n\r with <br /> tag and then explode depend on it to get array of all keywords
       $keys=explode('<br />',preg_replace("/\r\n|\r|\n/", '<br />', $keyword));
       $new_keys=array();
       foreach($keys as $k){
           //handel each array element to be span tag
           array_push($new_keys,'<span class="badge bg-secondary">'.$k.'</span><br/>');
       }
       // then convert array to string to be stored in db
       return implode($new_keys);
    }
}
