<?php
namespace App\Http\Repositories\Admin;
use App\Models\Area;
use App\Models\Country;
use App\Models\Province;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use App\Http\Interfaces\Admin\ProvienceInterface;

class ProvienceRepository implements ProvienceInterface {
    public function index() {
        $countries = Country::get();
        return view('dashboard.admin.proviences.index', compact('countries'));
    }

    public function data() {
        $proviences = Province::with(['country','areas']);
        return DataTables::of($proviences)
            ->addColumn('country', function (Province $provience) {
                return $provience->country->name;
            })
            ->addColumn('areas', function (Province $provience) {
                return view('dashboard.admin.proviences.btn.related', compact('provience'));
            })
            ->addColumn('record_select', 'dashboard.admin.proviences.data_table.record_select')
            ->editColumn('created_at', function (Province $provience) {
                return $provience->created_at->diffforhumans();
            })
            ->addColumn('actions', 'dashboard.admin.proviences.data_table.actions')
            ->rawColumns([ 'record_select','actions'])
            ->toJson();
    }

    public function store($request) {
        Province::create([
            'name'  => $request->input('name'),
            'country_id'    =>  $request->country_id,
        ]);
        toastr()->success(__('Admin/site.added_successfully'));
        return redirect()->route('Proviences.index');
    }

    public function edit($id) {
        $provinceID = Crypt::decrypt($id);
        $provience=Province::findorfail($provinceID);
        $countries = Country::get();
        return view('dashboard.admin.proviences.data_table.edit', compact('provience', 'countries'));
    }

    public function update($request,$id) {
        $provinceID = Crypt::decrypt($id);
        $provience=Province::findorfail($provinceID);
        $provience->update([
            'name'  => $request->input('name'),
            'country_id'    =>  $request->country_id,
        ]);
        toastr()->success(__('Admin/site.added_successfully'));
        return redirect()->route('Proviences.index');
    }

    public function destroy($id) {
        $data = [];
        $provinceID = Crypt::decrypt($id);
        $data['area'] = Area::where('province_id', $provinceID)->pluck('province_id'); 
        if($data['area']->count() == 0) {
            $province=Province::findorfail($provinceID);
            $province->delete();
            toastr()->success(__('Admin/site.deleted_successfully'));
            return redirect()->route('Proviences.index');
        } else {
            toastr()->error(__('Admin/proviences.cant_delete'));
            return redirect()->route('Proviences.index');
        }
    }



    public function bulkDelete($request) {
        try {
            DB::beginTransaction();
            if ($request->delete_select_id) {
                $delete_select_id = explode(",", $request->delete_select_id);
                foreach ($delete_select_id as $province_ids) {
                    $province_ids = Crypt::decrypt($province_ids);

                    $province = Province::findorfail($province_ids);
                    $areas = $province->areas->count();

                    if ($areas > 0) {
                        toastr()->error(__('Admin/site.delete_related_areas'));
                        return redirect()->route('Proviences.index');
                    }

                    Province::destroy($province_ids);
                }
                DB::commit();

                toastr()->error(__('Admin/site.deleted_successfully'));
                return redirect()->route('Proviences.index');
            } else {
                toastr()->error(__('Admin/site.no_data_found'));
                return redirect()->route('Proviences.index');
            }
        }catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);

        }


    }// end of bulkDelete
}