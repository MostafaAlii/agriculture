<?php
namespace App\Http\Interfaces\Admin;
interface SliderInterface {
    public function addImages();
    public function saveSliderImages($request);
    public function saveSliderImagesDB($request);
}