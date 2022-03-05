<?php
namespace  App\Http\Interfaces;
interface UserInterface {
    public function index();
    public function store($request);
    public function update($request);
    public function destroy($request);
}