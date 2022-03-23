<?php
namespace  App\Http\Interfaces\Admin;
interface ProfileInterface {
    public function index();
    public function edit($admin);
    public function updateAccount($request,$admin);
    public function updateInformation($request,$admin);
    public function getProvince($id);
    public function getArea($id);
    public function getState($id);
    public function getVillage($id);
}
