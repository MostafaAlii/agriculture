<?php
namespace App\Http\Repositories\Admin;
use App\Http\Interfaces\Admin\SliderInterface;
class SliderRepository implements SliderInterface {
    public function index() {
        return view('dashboard.admin.sliders.index');
    }
}