<?php
namespace App\Http\Repositories\Admin;
use App\Models\Country;
use App\Models\Province;
use App\Http\Interfaces\Admin\ProvinceInterface;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
class ProvinceRepository implements ProvinceInterface{
    public function index() {
        return view('dashboard.admin.province.index');
    }

    public function data() {
        $provinces = Province::query();

        return DataTables::of($provinces)
            ->editColumn('created_at', function (Province $province) {
                return $province->created_at->format('Y-m-d');
            })
            ->addColumn('actions', 'dashboard.admin.province.data_table.actions')
            ->rawColumns([ 'actions'])
            ->toJson();
    }


    public function create() {
        $countries = Country::all();
        return view('dashboard\admin\province.create');

    }

    public function store($request) {

        DB::beginTransaction();
        try{
            $requestData = $request->validated();



            $province = Province::create($requestData);
            $province->name = $request->name;
            $province->save();
            DB::commit();

            toastr()->success(__('Admin/province.added_successfully'));
            return redirect()->route('provinces.index');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }
    public function edit($id) {
        $id_province  = Crypt::decrypt($id);
        $province = Province::findorfail($id_province)->first();
        $countries = Country::all();
        return view('dashboard.admin.province.edit', compact('province','countries'));
    }

    public function update( $request,$id) {
        try{
            $province=Province::findorfail($id);
            $requestData = $request->validated();
            $requestData['name'] = $request->name;
            $province->update($requestData);
            toastr()->success( __('Admin/site.updated_successfully'));
            return redirect()->route('provinces.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    public function destroy($id) {
        $province=Province::findorfail($id);
        $province->delete();
        toastr()->error(__('Admin/province.deleted_successfully'));
        return redirect()->route('provinces.index');
    }
}