<?php
namespace App\Http\Controllers\Dashboard\Admin;
use App\Http\Controllers\Controller;
use App\Http\Interfaces\Admin\AboutInterface;
use App\Http\Requests\Dashboard\AboutRequest;


class AboutController extends Controller
{
    protected $Data;
    public function __construct(AboutInterface $Data) {
        $this->middleware('permission:about-us', ['only' => ['show','save']]);
        $this->Data = $Data;
    }

    public function show() {
        return $this->Data->show();
    }

    public function save(AboutRequest $request)
    {
        return $this->Data->save($request);
    }

}
