<?php

namespace App\Http\Livewire\Front;

use App\Models\Contact;
use App\Models\Setting;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class ContactUs extends Component
{
    public $firstname;
    public $lastname;
    public $phone;
    public $email;
    public $comment;
    public function resetFields()
    {
       $this->firstname = '';
       $this->lastname  = '';
       $this->phone     = '';
       $this->email     = '';
       $this->comment   = '';
    }
    public function updated($fields){
       $this->validateOnly($fields,[
        'firstname'    =>'required|min:3|max:100|string',
        'lastname'     =>'required|min:3|max:100|string',
        'phone'        => 'required_with:email|string|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:11',
        'email'        => 'required|email|unique:contact_us,email',
        'comment'      =>'required|max:200',
       ]);
    }
    public function sendMessage(){
       $this->validate([
        'firstname'    => 'required|min:3|max:100|string',
        'lastname'     => 'required|min:3|max:100|string',
        'phone'        => 'required_with:email|string|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:11',
        'email'        => 'required|email|unique:contact_us,email',
        'comment'      => 'required|max:200',
       ]);
       DB::beginTransaction();
       try {

        Contact::create([
            'firstname'=>$this->firstname,
            'lastname'=>$this->lastname,
            'phone'=>$this->phone,
            'email'=>$this->email,
            'comment'=>$this->comment,
        ]);
            // $contact = new Contact();
            // $contact->firstname = $this->firstname;
            // $contact->lastname = $this->lastname;
            // $contact->phone = $this->phone;
            // $contact->email = $this->email;
            // $contact->comment = $this->comment;
            // $contact->save();

           Mail::send(
            'livewire.front.emails.contact',
            array(
                'title' => 'Contact Mail -- تواصل معنا ',
                'firstname' => $this->firstname,
                'lastname' => $this->lastname,
                'mail' => $this->email,
                'phone' => $this->phone,
                'content' => $this->comment,
            ),
            function ($message) {
                $message->subject("Contact Mail -- تواصل معنا ");
                $message->to(env('MAIL_FROM_ADDRESS','ahmedragabyasin2020@gmail.com'));
                $message->from($this->email);

            }
        );
        DB::commit();
        session()->flash('message',__('website\home.msg'));
        response()->json(['status'=>__('Website/home.subscribed_successfully')]);
        $this->resetFields();

        //------------------------------------------------------------------
        } catch (\Exception $e) {
           DB::rollBack();
           return redirect()->back()->withErrors(['error' => $e->getMessage()]);

        //    toastr()->error(__('Admin/contact.send_fail'));
            // return redirect()->back();

        }
    }
    public function render()
    {
        $data['contact_info']=Setting::first();
        return view('livewire.front.contact-us',$data)->layout('front.layouts.master3');
    }
}
