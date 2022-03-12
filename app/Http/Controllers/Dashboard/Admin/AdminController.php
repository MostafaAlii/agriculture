<?php
namespace App\Http\Controllers\Dashboard\Admin;
use App\Http\Controllers\Controller;
use App\Http\Interfaces\Admin\AdminInterface;
use App\Http\Requests\AdminRequest;
use App\Models\Admin;
use Illuminate\Http\Request;
class AdminController extends Controller {

    protected $Data;
    public function __construct(AdminInterface $Data) {
        $this->Data = $Data;
    }

    public function index() {
        return $this->Data->index();

    }

    public function data()
    {
        return $this->Data->data();

    }// end of data

    public function create() {
        return $this->Data->create();
    }

    public function store(AdminRequest $request)
    {
        return $this->Data->store($request);
    }// end of store

    public function edit(Admin $admin)
    {
        dd($admin->id);
        return $this->Data->edit($admin);

    }// end of edit

    public function update(AdminRequest $request, Admin $admin)
    {
        return $this->Data->update($request,$admin);
    }// end of update

    public function destroy(Admin $admin)
    {
        return $this->Data->destroy($admin);

    }// end of destroy
}
