<?php
namespace App\Http\Interfaces\Admin;
interface ContactInterface {
    public function show();
    public function replay($request,$id);
    public function send($request);
    public function delete($request);
}