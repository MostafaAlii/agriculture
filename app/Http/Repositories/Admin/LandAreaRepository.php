<?php
namespace  App\Http\Repositories\Admin;
use App\Http\Interfaces\Admin\LandAreaInterface;
use App\Models\LandArea;
use App\Models\Admin;
use App\Models\Area;
use App\Models\Village;
use App\Models\LandCategory;
use App\Models\State;
use App\Models\Unit;
use App\Models\AdminDepartment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use App\Traits\UploadT;
use Auth;
use Yajra\DataTables\DataTables;
class LandAreaRepository implements LandAreaInterface{

    public function index() {

        return view('dashboard.admin.land_areas.index') ;
    }

    public function data()
    {
        $land_areas = LandArea::with('area', 'state','village','landCategory');

        return DataTables::of($land_areas)
            ->addColumn('record_select', 'dashboard.admin.land_areas.data_table.record_select')
            ->addIndexColumn()
            ->editColumn('created_at', function (LandArea $land_area) {
                return $land_area ->created_at->diffforhumans();
            })
            ->addColumn('area', function (LandArea $land_area) {
                return $land_area->area->name;
            })
            ->addColumn('state', function (LandArea $land_area) {
                return $land_area->state->name;
            })
            ->addColumn('village', function (LandArea $land_area) {
                return $land_area->village->name;
            })
            ->addColumn('landCategory', function (LandArea $land_area) {
                return $land_area->landCategory->category_name;
            })


            ->addColumn('actions', 'dashboard.admin.land_areas.data_table.actions')
            ->rawColumns(['record_select', 'actions'])
            ->toJson();

    }



    public function create() {
        $areas = Area::all();
        $states = State::all();
        $land_categories= LandCategory::all();
        $admins = Admin::all();
        $admin_dpartments = AdminDepartment::all();

        $units = Unit::all();


        return view('dashboard.admin.land_areas.create',
            compact( 'admin_dpartments', 'areas', 'states', 'units','land_categories'));
    }

    public function store($request) {
        DB::beginTransaction();
        try {
            $requestData = $request->validated();
            $landArea = new LandArea();
            $landArea->admin_id = Auth::user()->id;
            $landArea->area_id = $requestData['area_id'];
            $landArea->state_id = $requestData['state_id'];
            $landArea->village_id = $requestData['village_id'];
            $landArea->admin_department_id = $requestData['admin_department_id'];
            $landArea->L_area = $requestData['L_area'];
            $landArea->land_category_id = $requestData['land_category_id'];
            $landArea->unit_id = $requestData['unit_id'];



            $landArea->save($requestData);

            DB::commit();
            toastr()->success(__('Admin/site.added_successfully'));
            return redirect()->route('LandAreas.index');


        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['Error' => $e->getMessage()]);
        }
    }

    public function show($id) {
        //
    }

    public function edit($id)
    {
        $LandID = Crypt::decrypt($id);
        $areas = Area::all();
        $states = State::all();
        $land_categories= LandCategory::all();
        $admins = Admin::all();
        $admin_dpartments = AdminDepartment::all();
        $land_area = LandArea::findorfail($LandID);
        $units = Unit::all();

        return view('dashboard.admin.land_areas.edit',
            compact('admin_dpartments', 'areas', 'states', 'units','land_area','land_categories'));
    }

    public function update($request, $id) {
        DB::beginTransaction();
        try {
            $LandID = Crypt::decrypt($id);

            $requestData = $request->validated();
            $landArea = LandArea::findorfail($LandID);
            $landArea->admin_id = Auth::user()->id;
            $landArea->area_id = $requestData['area_id'];
            $landArea->state_id = $requestData['state_id'];
            $landArea->village_id = $requestData['village_id'];
            $landArea->admin_department_id = $requestData['admin_department_id'];
            $landArea->L_area = $requestData['L_area'];
            $landArea->land_category_id = $requestData['land_category_id'];
            $landArea->unit_id = $requestData['unit_id'];



            $landArea->update($requestData);

            DB::commit();
            toastr()->success(__('Admin/site.added_successfully'));
            return redirect()->route('LandAreas.index');


        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['Error' => $e->getMessage()]);
        }
    }

    public function destroy($id) {
        $landAreaID = Crypt::decrypt($id);
        $land_area = LandArea::findorfail($landAreaID);


        $land_area->delete();
        toastr()->success(__('Admin/site.deleted_successfully'));
        return redirect()->route('LandAreas.index');

    }

    public function bulkDelete($request) {
        try {
            DB::beginTransaction();
            if ($request->delete_select_id) {
                $delete_select_id = explode(",", $request->delete_select_id);
                foreach ($delete_select_id as $landArea_ids) {

                    $land_area = LandArea::findorfail($landArea_ids);


                    LandArea::destroy($landArea_ids);
                }
                DB::commit();

                toastr()->error(__('Admin/site.deleted_successfully'));
                return redirect()->route('LandAreas.index');
            } else {
                toastr()->error(__('Admin/site.no_data_found'));
                return redirect()->route('LandAreas.index');
            }
        }catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);

        }


    }// end of bulkDelete


}