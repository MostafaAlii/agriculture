<?php
namespace  App\Http\Interfaces\Admin;
interface SettingInterface{
    public function index();
    public function store($request);

}