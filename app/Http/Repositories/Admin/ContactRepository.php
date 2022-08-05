<?php
namespace App\Http\Repositories\Admin;
use App\Models\Contact;
use Illuminate\Support\Facades\Mail;
use App\Http\Interfaces\Admin\ContactInterface;

class ContactRepository implements ContactInterface {
    
    public function show() {
        $data['mails']=Contact::orderBy('created_at','desc')->Paginate(10);
        return view('dashboard.admin.contact_us_mails',$data);
    }

    public function replay($request,$id){
        $mail_name='sender_mail_'.$id;
        $comment_name='comment_'.$id;
       try {

           Mail::send(
            'livewire.front.emails.contact',
            array(
                'title' => ' Replay to your message.. ',
                'content' => $request[$comment_name],
            ),
            function ($message) use ($request,$id)  {
                $mail_name='sender_mail_'.$id;
                $message->subject("Replay to your message.. ");
                $message->to($request[$mail_name]);
                $message->from(env('MAIL_FROM_ADDRESS'));
            }
        );
        toastr()->success(__('Admin/contact.send_done'));
        return redirect()->back()->with(['success'=>__('Admin/contact.send_done')]);           
        //------------------------------------------------------------------
        } catch (\Exception $e) {
           // dd($e->getMessage());
           toastr()->error(__('Admin/contact.send_fail'));
           return redirect()->back()->with(['error'=>__('Admin/contact.send_fail')]);           
        }
    }

    public function send($request){

       try {

        Mail::send(
            'livewire.front.emails.contact',
            array(
                'title' => $request['emailSubject'],
                'content' => $request['emailComment'],
            ),
            function ($message) use ($request){
                $message->subject($request['emailSubject']);
                $message->from(env('MAIL_FROM_ADDRESS'));
                $message->to($request['emailTo']);

            }
        );

        toastr()->success(__('Admin/contact.send_done'));
        return redirect()->back()->with(['success'=>__('Admin/contact.send_done')]);           
        //------------------------------------------------------------------
        } catch (\Exception $e) {
           // dd($e->getMessage());
           toastr()->error(__('Admin/contact.send_fail'));
           return redirect()->back()->with(['error'=>__('Admin/contact.send_fail')]);           
        }
    }

    public function delete($request){
       // dd($request->delete_select_id);
        if($request->delete_select_id){
            $all_ids = explode(',',$request->delete_select_id);
            
            foreach($all_ids as $ids){
                Contact::findorfail($ids)->delete();
            }
           
             toastr()->error(__('Admin/attributes.delete_done'));
             return redirect()->back()->with(['error'=>__('Admin/contact.delete_done')]);           
            
        }else{
            toastr()->error(__('Admin/site.no_data_found'));
            return redirect()->back()->with(['error'=>__('Admin/contact.no_data_found')]);           
        }
    }
}