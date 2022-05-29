<?php
namespace  App\Http\Repositories\Admin;
use App\Http\Interfaces\Admin\SettingInterface;
use Illuminate\Support\Facades\Crypt;
use App\Models\Setting;
use Illuminate\Support\Facades\DB;
use App\Traits\UploadT;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Up;
use File;
class SettingRepository implements SettingInterface{
    public function index() {

        $setting = Setting::orderBy('id','desc')->first();

        return view('dashboard.admin.settings.settings',compact('setting'));
    }

    public function store($request) {

        {

            DB::beginTransaction();
            try {
                $validated = $request->validated();
                $setting = Setting::OrderBy('id','desc')->first();
                $dataRequest = $request->except(['site_logo','site_icon']);
                $setting->support_mail = $dataRequest['support_mail'];
                $setting->primary_phone = $dataRequest['primary_phone'];
                $setting->secondery_phone = $dataRequest['secondery_phone'];
                $setting->facebook = $dataRequest['facebook'];
                $setting->twitter = $dataRequest['twitter'];
                $setting->inestegram = $dataRequest['inestegram'];

                $setting->status =  (isset($dataRequest['status']) ? $dataRequest['status'] : 'open');


                if($request->site_logo) {

                    if(File::exists(public_path('Dashboard/img/settingLogo/' . $setting->site_logo)))
                    {
                        File::delete(public_path('Dashboard/img/settingLogo/' . $setting->site_logo));
                    }
                    Image::make($request->site_logo)->resize(70, 70, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save(public_path('Dashboard/img/settingLogo/' . $request->site_logo->hashName()));

                         $dataRequest['site_logo'] = $request->site_logo->hashName();
                }
                    if($request->site_icon) {

                    if(File::exists(public_path('Dashboard/img/settingIcon/' . $setting->site_icon)))
                    {
                        File::delete(public_path('Dashboard/img/settingIcon/' . $setting->site_icon));
                    }
                    Image::make($request->site_icon)->resize(70, 70, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save(public_path('Dashboard/img/settingIcon/' . $request->site_icon->hashName()));

                       $dataRequest['site_icon'] = $request->site_icon->hashName();
                }
                $setting->update($dataRequest);


                $setting->site_name= $dataRequest['site_name'];
                $setting->address= $dataRequest['address'];
                $setting->message_maintenance = $dataRequest['message_maintenance'];
                $setting->update($dataRequest);

                DB::commit();
                toastr()->success(__('Admin/general.success_update'));
                return redirect()->route('settings');

            } catch (\Exception $e) {
                DB::rollBack();
                toastr()->success(__('Admin/attributes.edit_wrong'));

                return redirect()->back();

            }
        }


    }


}