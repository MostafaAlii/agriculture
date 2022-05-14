<?php

namespace App\Http\Livewire\Front;

use App\Models\Contact;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
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
           'firstname'    =>'required|min:3|max:100',
           'lastname'     =>'required|min:3|max:100',
           'phone'        => 'required|min:11|numeric|regex:/(0)[0-9]{9}/',
           'email'        =>'required|email',
           'comment'      =>'required|regex:/^[A-Za-z0-9-أ-ي-pL\s\-]+$/u',
       ]);
    }
    public function sendMessage(){
       $this->validate([
        'firstname'    =>'required|min:3|max:100|regex:/^[A-Za-z-أ-ي-pL\s\-]+$/u',
        'lastname'     =>'required|min:3|max:100|regex:/^[A-Za-z-أ-ي-pL\s\-]+$/u',
        'phone'        => 'required|min:11|numeric|regex:/(0)[0-9]{9}/',
        'email'        =>'required|email',
        'comment'      =>'required|regex:/^[A-Za-z0-9-أ-ي-pL\s\-]+$/u',
       ]);
       try {
            $contact = new Contact();
            $contact->firstname = $this->firstname;
            $contact->lastname = $this->lastname;
            $contact->phone = $this->phone;
            $contact->email = $this->email;
            $contact->comment = $this->comment;
            $contact->save();
           


        //------------------------------------------------------------------
        //     $data=[
        //         'title' => 'Contact Mail -- تواصل معنا ',
        //         'firstname' => $this->firstname,
        //         'lastname' => $this->lastname,
        //         'mail' => $this->email,
        //         'phone' => $this->phone,
        //         'content' => $this->comment,
        //    ];

         //  Mail::to($site)->send(new ConatctEmail($data));


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
                $message->to(env('MAIL_FROM_ADDRESS','magdasaif3@gmail.com'));
               // $message->to('eradunited@murabba.dev');
                $message->from($this->email);

            }
        );

        session()->flash('message','Thanks your message has been sent successfully !');
        // session()->flash('add');
        $this->resetFields();
        
        //------------------------------------------------------------------
        } catch (\Exception $e) {
          //  DB::rollBack();
           // dd($e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);

        }
    }
    public function render()
    {
        return view('livewire.front.contact-us')->layout('front.layouts.master3');
    }
}
