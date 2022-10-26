<?php
namespace App\Http\Repositories\Admin;
use App\Models\About;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use App\Http\Interfaces\Admin\AboutInterface;

class AboutRepository implements AboutInterface {
//------------------------------------------------------------------------------------------
    public function show() {

        $data['info']   =About::first();
       return view('dashboard.admin.about.form',$data);

    }
//------------------------------------------------------------------------------------------
    public function save($request) {
            DB::beginTransaction();
            try {
                $data = $request->except(['_token','_method','image']);
                $data['title'] = $request->name;
                $about = About::first();
                if($request->hasFile('image')) {
                    $data['image'] = $this->uploadImage($request->image, 'about');
                }
                $about->update($data);
                DB::commit();
                toastr()->success(__('Admin/about.updated_done'));
                return redirect()->route('about_us/show');
            } catch (\Exception $e) {
                DB::rollback();
                toastr()->success(__('Admin/about.edit_wrong'));
                return redirect()->route('about_us/show');
            }
    }
    public function uploadImage($image, $folder = 'about') {
        $image->store('/', $folder);
        $filename = $image->hashName();
        $path = public_path('Dashboard/img/' . $folder . '/' . $filename);
        Image::make($image->getRealPath())->resize(600, 400, function ($constraint) {
            $constraint->aspectRatio();
        })->save($path, 100);
        return $filename;
    }
}