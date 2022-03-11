<?php
namespace App\Http\Controllers\Dashboard\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\FarmerRequest;
use App\Models\Farmer;
//use App\Http\Interfaces\AdminInterface;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class FarmerController extends Controller {
    // protected $Data;
    /*public function __construct(AdminInterface $Data) {
        $this->Data = $Data;
    }*/

    public function index() {
        //return $this->Data->index();
        return view('dashboard.admin.farmers.index');
    }

    public function data()
    {
        $farmers = Farmer::select();

        return DataTables::of($farmers)
            ->editColumn('created_at', function (Farmer $farmer) {
                return $farmer->created_at->format('Y-m-d');
            })
            ->addColumn('actions', 'dashboard.admin.farmers.data_table.actions')
            ->rawColumns([ 'actions'])
            ->toJson();

    }// end of data

    public function create() {
        return view('dashboard.admin.farmers.create');
    }

    public function store(FarmerRequest $request)
    {
         try{
            $requestData = $request->validated();
            $requestData['password'] = bcrypt($request->password);
            Farmer::create($requestData);
            // session()->flash('add');
            // session()->flash('Add', __('Admin/site.added_successfully'));
            toastr()->success(__('Admin/site.added_successfully'));
            return redirect()->route('farmers.index');
         } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
         }
    }// end of store

    public function edit(Farmer $farmer)
    {
        return view('dashboard.admin.farmers.edit', compact('farmer'));

    }// end of edit

    public function update(FarmerRequest $request, Farmer $farmer)
    {
        try{
            $farmer->update($request->validated());

            // session()->flash('Edit', __('Admin/site.updated_successfully'));
            toastr()->success( __('Admin/site.updated_successfully'));
            return redirect()->route('farmers.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }// end of update

    public function destroy(Farmer $farmer)
    {
        $farmer->delete();
        // session()->flash('Delete', __('Admin/site.deleted_successfully'));
        toastr()->error(__('Admin/site.deleted_successfully'));
        return redirect()->route('farmers.index');

    }// end of destroy
}
