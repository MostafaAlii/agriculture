<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\File;


class Upload extends Controller
{
    //$request,$path,$new_name=null ,$upload_type='single',$delete_file=null,$crud_type=[], $file_type,$relation_id
    /*static public function upload($data=[]){
        if(in_array('new_name',$data)){
            $new_name = $data['new_name']===null?time():$data['new_name'];

        }
          if(request()->hasFile($data['file'])&& $data['upload_type'] =='single' ){
                  Storage::has($data['delete_file'])?  Storage::delete($data['delete_file']):'';

              return request()->file($data['file'])->store($data['path']) ;
          }
          }*/
    static public function upload($request,$path,$new_name=null) {
        $new_name = $new_name===null?time():$new_name;
        if($request->hasFile('file')) {
            $file = $request->file('file');
            $file_name = $new_name .'_' .time(). '.' .$file->getClientOriginalExtension();
            $file->move($path,$file_name);
            return $file_name;
        }
    }
}