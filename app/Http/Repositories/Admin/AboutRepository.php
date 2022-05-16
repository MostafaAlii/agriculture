<?php
namespace App\Http\Repositories\Admin;
use App\Models\About;
use App\Models\Image;
use App\Traits\UploadT;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use App\Http\Interfaces\Admin\AboutInterface;

class AboutRepository implements AboutInterface {
    use UploadT;

//------------------------------------------------------------------------------------------
    public function show() {
        $data['info']   =About::first();

      $data['about_cache']= Cache::get('about_us');
       return view('dashboard.admin.about.form',$data);

    }
//------------------------------------------------------------------------------------------
    public function save($request) {
        DB::beginTransaction();
        //dd($request->all());
        try{
            $info = About::first();
            
            $info->title=$request->name;
            $info->description=$request->description;
            $info->save();

            if(isset($request->image)){
                if($info->image) {
                    $old_photo = $info->image->filename;
                    $this->Delete_attachment('about', $old_photo, $info->id, $old_photo);
                }
                //===========add new image and store in image table=========================
                $photo_name= str_replace(' ', '_',($request->image)->getClientOriginalName());
                ($request->image)->storeAs('',$photo_name,$disk="about");
                 // insert Image
                $Image = new Image();
                $Image->filename = $photo_name;
                $Image->imageable_id = $info->id;
                $Image->imageable_type = 'App\Models\About';
                $Image->save();
                //============================================================================
            }

             //==============update cache file=================
             $i=About::get();
             Cache::store('file')->put('about_us',$i);
            //==================================================

            DB::commit();
            toastr()->success(__('Admin/about.updated_done'));
            return redirect()->route('about_us/show');
        } catch (\Exception $ex) {
            DB::rollBack();
            toastr()->success(__('Admin/about.edit_wrong'));
            return redirect()->route('about_us/show');
         }
    }
//------------------------------------------------------------------------------------------
}