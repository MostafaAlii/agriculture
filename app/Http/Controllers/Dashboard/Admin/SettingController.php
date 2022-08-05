<?php
namespace App\Http\Controllers\Dashboard\Admin;
use App\Http\Controllers\Controller;
use App\Http\Interfaces\Admin\SettingInterface;
use App\Http\Requests\Dashboard\SettingRequest;
class SettingController extends Controller {
    protected $Data;
    public function __construct(SettingInterface $Data) {
        $this->middleware('permission:settings', ['only' => ['index','store']]);
        $this->Data = $Data;
    }

    public function index() {
        return $this->Data->index();
    }

    public function store(SettingRequest $request) {
        return $this->Data->store($request);
    }





}
