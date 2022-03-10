<?php
namespace App\Http\Controllers\Dashboard\Admin;
use App\Http\Controllers\Controller;
use App\Models\User;
//use App\Http\Interfaces\AdminInterface;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class UserController extends Controller {
    // protected $Data;
    /*public function __construct(AdminInterface $Data) {
        $this->Data = $Data;
    }*/

    public function index() {
        //return $this->Data->index();
        return view('dashboard.admin.users.index');
    }

    public function data()
    {
        $users = User::select();

        return DataTables::of($users)
            ->editColumn('created_at', function (User $user) {
                return $user->created_at->format('Y-m-d');
            })
            // ->addColumn('actions', 'admin.users.data_table.actions')
            // ->rawColumns([ 'actions'])
            ->toJson();

    }// end of data

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
