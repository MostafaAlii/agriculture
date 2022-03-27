<?php
namespace App\Http\Interfaces\Admin;
interface SliderInterface {
    // public function addImages();
    // public function saveSliderImages($request);
    // public function saveSliderImagesDB($request);
    public function index();
    public function data();
    public function create();
    public function store($request);
    public function edit($id);
    public function update($request,$id);
    public function destroy($id);
    public function bulkDelete($request);
}
