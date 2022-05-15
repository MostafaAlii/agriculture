<?php
namespace App\Http\Controllers\Dashboard\Admin;
use App\Http\Controllers\Controller;
use App\Http\Interfaces\Admin\RoleRepositoryInterface;
use Illuminate\Http\Request;
class RoleController extends Controller
{
    protected $Data;
    public function __construct(RoleRepositoryInterface $Data) {
        $this->Data = $Data;
    }

    public function index() {
        return $this->Data->index();
    }

    public function create() {
        //
    }

    public function store(Request $request) {
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
