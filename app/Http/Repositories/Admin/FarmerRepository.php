<?php
namespace  App\Http\Repositories\Admin;
use App\Models\Farmer;
use App\Http\Interfaces\Admin\FarmerInterface;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class FarmerRepository implements FarmerInterface{

    public function index() {
        return view('dashboard.admin.farmers.index');
    }
    public function data() {
        $farmers = Farmer::select();

        return DataTables::of($farmers)
            ->editColumn('created_at', function (Farmer $farmer) {
                return $farmer->created_at->format('Y-m-d');
            })
            ->addColumn('actions', 'dashboard.admin.farmers.data_table.actions')
            ->rawColumns([ 'actions'])
            ->toJson();
    }

    public function create() {
        return view('dashboard.admin.farmers.create');
    }
    public function store($request) {
        try{
            $requestData = $request->validated();
            $requestData['password'] = bcrypt($request->password);
            Farmer::create($requestData);
            toastr()->success(__('Admin/site.added_successfully'));
            return redirect()->route('farmers.index');
         } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
         }
    }

    public function edit($farmer) {
        return view('dashboard.admin.farmers.edit', compact('farmer'));
    }

    public function update( $request,$farmer) {
        try{
            $farmer->update($request->validated());

            // session()->flash('Edit', __('Admin/site.updated_successfully'));
            toastr()->success( __('Admin/site.updated_successfully'));
            return redirect()->route('farmers.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy($farmer) {
        $farmer->delete();
        toastr()->error(__('Admin/site.deleted_successfully'));
        return redirect()->route('farmers.index');
    }
}
