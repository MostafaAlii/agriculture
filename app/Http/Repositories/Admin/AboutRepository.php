<?php
namespace App\Http\Repositories\Admin;
use App\Models\About;
use App\Traits\UploadT;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use App\Http\Interfaces\Admin\AboutInterface;

use Intervention\Image\Facades\Image;

class AboutRepository implements AboutInterface {
    use UploadT;

//------------------------------------------------------------------------------------------
    public function show() {

        $data['info']   =About::first();

       //read info from cache
       $data['about_cache']= Cache::get('about_us');
       
       return view('dashboard.admin.about.form',$data);

    }
//------------------------------------------------------------------------------------------
    public function save($request) {
        DB::beginTransaction();
        //dd($request->all());
        try{
            $info = About::first();
            //apply editing info
            $info->title=$request->name;
            $info->description=$request->description;
            
            if(isset($request->image)){
                if($info->image) {//delete old image
                    unlink(public_path().'\Dashboard\img\about\\'.$info->image);
                    //$this->Delete_attachment('about', $info->image, $info->id, $info->image);
                }
                //===========resize image and store in abouts table=========================
                $filename    = $request->image->getClientOriginalName();
                Image::make($request->image)->resize(600, 400, function ($constraint) {
                    $constraint->aspectRatio();
                })->save(public_path('Dashboard/img/about/' . $filename));
                $info->image=$filename;
                 //============================================================================
            }
            $info->save();
            
             //==============update cache file=================
             $i=About::get();
             Cache::store('file')->put('about_us',$i);
            //==================================================

            DB::commit();
            toastr()->success(__('Admin/about.updated_done'));
            return redirect()->route('about_us/show');
        } catch (\Exception $ex) {
           // dd($ex->getMessage());
            DB::rollBack();
            toastr()->success(__('Admin/about.edit_wrong'));
            return redirect()->route('about_us/show');
         }
    }
//------------------------------------------------------------------------------------------
}