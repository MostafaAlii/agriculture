<?php
namespace App\Http\Repositories\Admin;
use App\Http\Interfaces\Admin\ContactInterface;
use App\Models\Contact;

class ContactRepository implements ContactInterface {
    
    public function show() {
        $data['mails']=Contact::orderBy('created_at','desc')->get();
        return view('dashboard.admin.contact_us_mails',$data);
    }

}