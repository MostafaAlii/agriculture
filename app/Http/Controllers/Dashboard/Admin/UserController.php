<?php
namespace App\Http\Controllers\Dashboard\Admin;
use App\Http\Controllers\Controller;
//use App\Http\Interfaces\AdminInterface;
use Illuminate\Http\Request;
class UserController extends Controller {
    // protected $Data;
    /*public function __construct(AdminInterface $Data) {
        $this->Data = $Data;
    }*/

    public function index() {
        //return $this->Data->index();
        return view('dashboard.admin.users.index');
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
