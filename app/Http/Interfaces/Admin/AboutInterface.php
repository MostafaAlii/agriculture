<?php
namespace App\Http\Interfaces\Admin;
interface AboutInterface {
    public function show();
    public function save($request);
}