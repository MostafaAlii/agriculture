<?php
namespace App\Http\Controllers\Dashboard\Admin;
use App\Http\Controllers\Controller;
use App\Http\Interfaces\Admin\SliderInterface;
use App\Http\Requests\Dashboard\SliderRequest;
use Illuminate\Http\Request;
class SliderController extends Controller
{
    protected $Data;
    public function __construct(SliderInterface $Data) {
        $this->Data = $Data;
    }

    public function addImages() {
        return $this->Data->addImages();
    }

    public function saveSliderImages(Request $request){
        return $this->Data->saveSliderImages($request);
    }

    public function saveSliderImagesDB(SliderRequest $request){
        return $this->Data->saveSliderImagesDB($request);
    }

    public function destroy($id) {
        //
    }
}