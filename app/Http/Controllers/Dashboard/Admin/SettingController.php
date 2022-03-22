<?php
namespace App\Http\Controllers\Dashboard\Admin;
use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\SettingTranslation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Traits\UploadT;
use Intervention\Image\Facades\Image;

use App\Http\Requests\Dashboard\SettingRequest;
use Illuminate\Support\Facades\Storage;
use Up;

class SettingController extends Controller
{
    use UploadT;
    public function index()
    {

        $setting = Setting::orderBy('id','desc')->first();
        $setting_t = SettingTranslation::orderBy('id','desc')->first();
      return view('dashboard.admin.setting',compact('setting','setting_t'));

        return view('dashboard.admin.settings.settings');

    }




    public function store(SettingRequest $request)
    {
        $validated = $request->validated();
//
        DB::beginTransaction();
        try {

            $setting = Setting::OrderBy('id','desc')->first();
            $dataRequest = $request->except(['site_logo','site_icon']);
            $setting->support_mail = $dataRequest['support_mail'];
            $setting->primary_phone = $dataRequest['primary_phone'];
            $setting->secondery_phone = $dataRequest['secondery_phone'];
            $setting->facebook = $dataRequest['facebook'];
            $setting->twitter = $dataRequest['twitter'];
            $setting->inestegram = $dataRequest['inestegram'];
            $setting->status = $dataRequest['status'];
            if($request->site_logo) {
                if($setting->site_logo != 'default_logo.jpg') {
                    Storage::disk('upload_image')->delete('/settingLogo/' . $setting->site_logo);
                }
                Image::make($request->site_logo)->resize(150, 150, function ($constraint) {
                    $constraint->aspectRatio();
                })->save(public_path('Dashboard/img/settingLogo/' . $request->site_logo->hashName()));
                $dataRequest['site_logo'] = $request->site_logo->hashName();
            }
            if($request->site_icon) {
                if($setting->site_icon != 'default_icon.jpg') {
                    Storage::disk('upload_image')->delete('/settingIcon/' . $setting->site_icon);
                }
                Image::make($request->site_icon)->resize(150, 150, function ($constraint) {
                    $constraint->aspectRatio();
                })->save(public_path('Dashboard/img/settingIcon/' . $request->site_icon->hashName()));
                $dataRequest['site_icon'] = $request->site_icon->hashName();
            }
            $setting->update($dataRequest);

//            if(request()->hasFile('site_logo')){
//                $data['site_logo'] = Up::upload([
//                    'new_name'=>'',
//                    'path'=> 'settings',
//                    'file'=>'site_logo',
//                    'upload_type'=>'single',
//                    'delete_file'=>setting()->site_logo,
//
//                ]);
//
//            }
//            $setting->site_logo =$data['site_logo'];
//            if(request()->hasFile('site_icon')){
//                $data['site_icon'] = Up()->upload([
//                    'new_name'=>'',
//                    'path'=> 'settings',
//                    'file'=>'site_icon',
//                    'upload_type'=>'single',
//                    'delete_file'=>setting()->site_icon,]);
//
//
//            }
//            $setting->site_icon =$data['site_icon'];
//            $setting->update();
            $setting->site_name= $request->site_name;
            $setting->address= $request->address;
            $setting->message_maintenance = $request->message_maintenance;
            $setting->update();

            DB::commit();
            toastr()->success(__('Admin/general.success_update'));
            return redirect()->route('settings');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);

        }
    }





}
