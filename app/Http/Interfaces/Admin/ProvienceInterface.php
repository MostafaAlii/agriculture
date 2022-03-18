<?php
namespace App\Http\Interfaces\Admin;
interface ProvienceInterface {
    public function index ();
    public function data();
    public function store($request);
}