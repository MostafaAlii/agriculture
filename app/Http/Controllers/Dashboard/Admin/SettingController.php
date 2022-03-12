<?php
namespace App\Http\Controllers\Dashboard\Admin;
use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\Image;
use App\Models\SettingTranslation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Traits\UploadT;

use App\Http\Requests\Dashboard\SettingRequest;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    use UploadT;
    public function setting()
    {

        $setting = Setting::orderBy('id','desc')->first();
        $setting_t = SettingTranslation::orderBy('id','desc')->first();
      return view('dashboard.admin.setting',compact('setting','setting_t'));

        return view('dashboard.admin.settings.settings');

    }




    public function save_setting(SettingRequest $request)
    {
        $validated = $request->validated();
//
        DB::beginTransaction();
        try {

            $setting = Setting::OrderBy('id','desc')->first();
            $setting->support_mail = $request->support_mail;
            $setting->primary_phone = $request->primary_phone;
            $setting->secondery_phone = $request->secondery_phone;
            $setting->facebook = $request->facebook;
            $setting->twitter = $request->twitter;
            $setting->inestegram = $request->inestegram;
            $setting->status = $request->status;
            if(request()->hasFile('site_logo')){
                !empty($setting->site_logo)?Storage::delete($setting->site_logo):'';
                $setting->site_logo  =  request()->file('site_logo')->store('settings') ;

            }
            if(request()->hasFile('site_icon')){
               !empty($setting->site_icon)?Storage::delete($setting->site_icon):'';

                $setting->site_icon  =  request()->file('site_icon')->store('settings') ;

            }

            $setting->update();
            $setting->site_name= $request->site_name;
            $setting->address= $request->address;
            $setting->message_maintenance = $request->message_maintenance;
            $setting->update();

            DB::commit();
            session()->flash('add');
            return redirect()->route('settings');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);

        }
    }





}
