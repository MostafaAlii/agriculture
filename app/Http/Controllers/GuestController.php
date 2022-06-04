<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\DataRequest;
use App\Models\Subscription;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class GuestController extends Controller
{
    // public function sendmails(DataRequest $request) {
        // return view('front.client.myOrders');
        // $emails=Data::select('email')->get();
        // try{
        //     $requestData = $request->validated();
        //     // Data::create($requestData);
        //     $data = new Data();
        //     $data->email = $request->email;
        //     $data->save();
        //     // return "hello";
        //     session()->flash('message',__('Admin/site.added_successfully'));
        //     return redirect()->back();
        //  } catch (\Exception $e) {
        //     session()->flash('message',__('Admin/site.sorry'));
        //     return redirect()->back();
        //  }
        // return "hello";
    // }

    public function sendmails(Request $request) {
        $email = $request->input('email');
        $validator = Validator::make($request->all(),
        [
           'email'    => 'required|email|unique:subscriptions,email',
        ]);
        if ($validator->fails()) {
            return response()->json(['status'=>$validator->errors()->first()]);
        }
        $data = new Subscription();
        $data->email = $email;
        $data->subscription_end_date = Carbon::today()->addMonth();
        $data->save();
        // return response()->json(['status'=>__('Website/home.subscribed_successfully')]);
        if(app()->getLocale()=='ar' || app()->getLocale()=='ku'){
            return response()->json(['status'=>'تم الاشتراك بنجاح']);

        }else{
            return response()->json(['status'=>__('Subscribed Successfully')]);
        }
        // return response()->json(['status'=>trans('Website/home.subscribed_successfully')]);
    }
}
