<?php
namespace App\Http\Controllers\Dashboard\Admin;
use App\Http\Controllers\Controller;
use App\Http\Interfaces\DepartmentInterface;
use App\Http\Requests\Dashboard\DepartmentRequest;
use Illuminate\Http\Request;
class DepartmentController extends Controller
{
    protected $Data;
    public function __construct(DepartmentInterface $Data) {
        $this->Data = $Data;
    }

    public function index() {
        return $this->Data->index();
    }

    public function create() {
        //
    }

    public function store(DepartmentRequest $request) {
        //
    }

    public function show($id) {
        //
    }

    public function edit(DepartmentRequest $request) {
        //
    }

    public function update(DepartmentRequest $request) {
        //
    }

    public function destroy(Request $request) {
        //
    }
}
