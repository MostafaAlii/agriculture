<?php
namespace App\Http\Controllers\Dashboard\Admin;
use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Traits\UploadT;
class SettingController extends Controller
{
    use UploadT;
    public function index()
    {
        return view('dashboard.admin.settings.settings');
    }




    public function store(Request $request)
    {
        $request->validate([
            'support_mail' => 'required|unique:settings|supporting_mail',
            'primary_phone' => 'required',
            'primary_phone'    => 'required|regex:/(0)[0-9]{9}/',
            'secondery_phone'    => 'required|regex:/(0)[0-9]{9}/',
            'facebook'=> 'required|url',
            'twitter'=> 'required|url',
            'inestegram'=> 'required|url',
            'site_name'=>'required|string'

        ]);
        DB::beginTransaction();
        try {

            $setting = new Setting();
            $setting->support_mail = $request->support_mail;
            $setting->primary_phone = $request->primary_phone;
            $setting->secondery_phone = $request->secondery_phone;
            $setting->facebook = $request->facebook;
            $setting->twitter = $request->twitter;
            $setting->inestegram = $request->inestegram;

            $setting->save();

            $setting->site_name = $request->site_name;
            $setting->address = $request->address;
            $setting->message_maintenance = $request->message_maintenance;
            $setting->save();
            // upload image
            UploadT::verifyAndStoreImage($request, 'site_logo', 'settings', 'upload_image', $setting->id, 'App\Models\Setting');
            UploadT::verifyAndStoreImage($request, 'site_icon', 'settings', 'upload_image', $setting->id, 'App\Models\Setting');

            DB::commit();
            session()->flash('add');
            return redirect()->route('settings');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);

        }
    }





}
