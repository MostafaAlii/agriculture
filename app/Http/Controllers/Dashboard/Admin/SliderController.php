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

    public function index() {
        return $this->Data->index();
    }

    public function create() {
        return $this->Data->create();
    }

    public function store(SliderRequest $request) {
        //
    }

    public function show($id) {
        //
    }

    public function edit($id) {
        //
    }

    public function update(Request $request, $id) {
        //
    }

    public function destroy($id) {
        //
    }
}
