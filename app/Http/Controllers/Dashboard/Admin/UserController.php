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
            session()->flash('Add', __('Admin/site.added_successfully'));
            return redirect()->route('users.index');
         } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
         }
    }// end of store

    public function edit(User $user)
    {
        return view('dashboard.admin.users.edit', compact('user'));

    }// end of edit

    public function update(UserRequest $request, User $user)
    {
        try{
            $user->update($request->validated());

            session()->flash('Edit', __('Admin/site.updated_successfully'));
            return redirect()->route('users.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }// end of update

    public function destroy(User $user)
    {
        $user->delete();
        session()->flash('Delete', __('Admin/site.deleted_successfully'));
        return redirect()->route('users.index');

    }// end of destroy
}
