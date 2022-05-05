<?php
namespace App\Http\Controllers\Dashboard\Admin;
use App\Http\Controllers\Controller;
use App\Http\Interfaces\Admin\ContactInterface;

class ContactController extends Controller {
    protected $Data;
    public function __construct(ContactInterface $Data) {
        $this->Data = $Data;
    }

    public function show() {
        return $this->Data->show();
    }

}
