<?php

namespace App\Http\Livewire\Front;

use App\Models\Contact;
use Livewire\Component;

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
           'firstname'    =>['required','min:3','max:100'],
           'lastname'     =>['required','min:3','max:100'],
           'phone'        => 'required|min:11|numeric',
           'email'        =>'required|email',
           'comment'      =>'required|regex:/^[A-Za-z0-9-أ-ي-pL\s\-]+$/u',
       ]);
    }
    public function sendMessage(){
       $this->validate([
        'firstname'    =>['required','min:3','max:100'],
        'lastname'     =>['required','min:3','max:100'],
        'phone'        => 'required|min:11|numeric',
        'email'        =>'required|email',
        'comment'      =>'required|regex:/^[A-Za-z0-9-أ-ي-pL\s\-]+$/u',
       ]);
       $contact = new Contact();
       $contact->firstname = $this->firstname;
       $contact->lastname = $this->lastname;
       $contact->phone = $this->phone;
       $contact->email = $this->email;
       $contact->comment = $this->comment;
       $contact->save();
       session()->flash('message','Thanks your message has been sent successfully !');
       $this->resetFields();
    }
    public function render()
    {
        return view('livewire.front.contact-us')->layout('front.layouts.master3');
    }
}
