<?php
namespace App\Http\Controllers\Dashboard\Admin;
use App\Http\Controllers\Controller;
use App\Http\Interfaces\Admin\UserInterface;
use App\Http\Requests\UserRequest;
use App\Models\User;
//use App\Http\Interfaces\AdminInterface;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class UserController extends Controller {
    protected $Data;
    public function __construct(UserInterface $Data) {
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

    public function store(UserRequest $request)
    {
        return $this->Data->store($request);
    }// end of store

    public function edit(User $user)
    {
        return $this->Data->edit($user);

    }// end of edit

    public function update(UserRequest $request, User $user)
    {
        return $this->Data->update($request,$user);
    }// end of update

    public function destroy(User $user)
    {
        return $this->Data->destroy($user);

    }// end of destroy
}
