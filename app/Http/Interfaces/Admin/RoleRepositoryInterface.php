<?php
namespace App\Http\Interfaces\Admin;
interface RoleRepositoryInterface {
    public function index();
    public function data();
    public function create();
    public function store($request);
}