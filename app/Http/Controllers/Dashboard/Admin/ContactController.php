<?php
namespace App\Http\Controllers\Dashboard\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Interfaces\Admin\ContactInterface;

class ContactController extends Controller {
    protected $Data;
    public function __construct(ContactInterface $Data) {
        $this->middleware('permission:contact-us', ['only' => ['show']]);
        $this->middleware('permission:send-new-contact-messeage', ['only' => ['send']]);
        $this->middleware('permission:contact-replay', ['only' => ['replay']]);
        $this->middleware('permission:contact-us-delete', ['only' => ['delete']]);
        $this->Data = $Data;
    }

    public function show() {
        return $this->Data->show();
    }
    
    public function replay(Request $request,$id) {
        return $this->Data->replay($request,$id);
    }

    public function send(Request $request) {
        return $this->Data->send($request);
    }

    public function delete(Request $request) {
        return $this->Data->delete($request);
    }

}
