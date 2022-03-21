<?php
namespace App\Http\Repositories\Admin;
use App\Http\Interfaces\Admin\SliderInterface;
use App\Models\Slider;
class SliderRepository implements SliderInterface {
    public function addImages() {
        $images = Slider::get(['photo']);
        return view('dashboard.admin.sliders.create', compact('images'));
    }

    public function saveSliderImages($request) {
        $file = $request->file('dzfile');
        $filename = uploadImage('sliders', $file);

        return response()->json([
            'name' => $filename,
            'original_name' => $file->getClientOriginalName(),
        ]);
    }

    public function saveSliderImagesDB($request) {
        try {
            $slider = new Slider();
            if ($request->has('slider') && count($request->slider) > 0) {
                foreach ($request->slider as $image) {
                    Slider::create([
                        $slider->photo => $image,
                    ]);
                }
            }
            toastr()->success(__('Admin/site.added_successfully'));
             return redirect()->route('sliders.create');
        } catch (\Exception $ex) {
            return redirect()->route('sliders.create')->withErrors(['error'=> $ex->getMessage()]);
        }
    }
}