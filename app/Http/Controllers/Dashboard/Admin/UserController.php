<?php
namespace App\Http\Controllers\Dashboard\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
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
            ->addColumn('actions', 'dashboard.admin.users.data_table.actions')
            ->rawColumns([ 'actions'])
            ->toJson();

    }// end of data

    public function create() {
        return view('dashboard.admin.users.create');
    }

    public function store(UserRequest $request)
    {
         try{
            $requestData = $request->validated();
            $requestData['password'] = bcrypt($request->password);
            User::create($requestData);
            session()->flash('add');
            return redirect()->route('users.index');
         } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
         }
    }// end of store

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
