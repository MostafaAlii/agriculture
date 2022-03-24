<?php
namespace App\Http\Interfaces\Admin;
interface OptionInterface {
    public function index($attr_id);
    public function show($attr_id);
    public function data($attr_id);
    public function store($request);
    public function edit($id);
    public function update($request,$id);
    public function destroy($id);
}