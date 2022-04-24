<?php
namespace  App\Http\Repositories\Admin;
use App\Http\Interfaces\Admin\ChickenProjectInterface;
use App\Models\ChickenProject;
use App\Models\Farmer;
use App\Models\Admin;
use App\Models\Area;
use App\Models\State;
use App\Models\Village;

use App\Models\AdminDepartment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use App\Traits\UploadT;
use Auth;
use Yajra\DataTables\DataTables;
class ChickenProjectRepository implements ChickenProjectInterface{

    public function index()
    {

        return view('dashboard.admin.chicken_projects.index');

    }
    public function data()
    {
        $chickenProjects = ChickenProject::with('farmer', 'village', 'adminDepartment');

        return DataTables::of($chickenProjects)
            ->addColumn('record_select', 'dashboard.admin.chicken_projects.data_table.record_select')
            ->addIndexColumn()
            ->editColumn('created_at', function (ChickenProject $chickenProject ) {
                return $chickenProject ->created_at->diffforhumans();
            })
            ->addColumn('farmer', function (ChickenProject $chickenProject) {
                return $chickenProject ->farmer->email;
            })
            ->addColumn('village', function (ChickenProject $chickenProject) {
                return $chickenProject->village->name;
            })

            ->addColumn('actions', 'dashboard.admin.chicken_projects.data_table.actions')
            ->rawColumns(['record_select', 'actions'])
            ->toJson();

    }

    public function create()
    {
        $areas = Area::all();
        $states = State::all();
        $villages = Village::all();
        $farmers = Farmer::all();
        $admins = Admin::all();
        $admin_dpartments = AdminDepartment::all();
        return view('dashboard.admin.chicken_projects.create',
            compact('farmers', 'admins', 'admin_dpartments', 'areas', 'villages','states'));
    }
    public function store($request)

    {
        DB::beginTransaction();
        try {
            $requestData = $request->validated();
            $chicken = new ChickenProject();
            $chicken->admin_id = Auth::user()->id;
            $chicken->farmer_id = $requestData['farmer_id'];
            $chicken->area_id = $requestData['area_id'];
            $chicken->state_id = $requestData['state_id'];
            $chicken->village_id = $requestData['village_id'];
            $chicken->admin_department_id = 1;


            $chicken->project_name = $requestData['project_name'];
            $chicken->hall_num = $requestData['hall_num'];
            $chicken->power = $requestData['power'];
            $chicken->food_source = $requestData['food_source'];
            $chicken->suse_source = $requestData['suse_source'];
            $chicken->marketing_side = $requestData['marketing_side'];
            $chicken->cost = $requestData['cost'];
            $chicken->phone = $requestData['phone'];
            $chicken->email = $requestData['email'];

            $chicken->save($requestData);

            DB::commit();
            toastr()->success(__('Admin/site.added_successfully'));
            return redirect()->route('Chickens.index');


        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['Error' => $e->getMessage()]);
        }

    }
    public function edit($id)
    {
        $animalID = Crypt::decrypt($id);
        $chicken = ChickenProject::findorfail($animalID);
        $areas = Area::all();
        $states = State::all();
        $villages = Village::all();
        $farmers = Farmer::all();
        $admins = Admin::all();
        $admin_dpartments = AdminDepartment::all();


        return view('dashboard.admin.chicken_projects.edit',
            compact('farmers', 'admin_dpartments', 'villages', 'states','areas','admins', 'chicken'));
    }

    public function update($request,$id)

    {
        DB::beginTransaction();
        try {
            $animalID = Crypt::decrypt($id);
            $requestData = $request->validated();
            $chicken = ChickenProject::findorfail($animalID);
            $chicken->admin_id = Auth::user()->id;
            $chicken->farmer_id = $requestData['farmer_id'];
            $chicken->area_id = $requestData['area_id'];
            $chicken->state_id = $requestData['state_id'];
            $chicken->village_id = $requestData['village_id'];
            $chicken->admin_department_id = 1;


            $chicken->project_name = $requestData['project_name'];
            $chicken->hall_num = $requestData['hall_num'];
            $chicken->power = $requestData['power'];
            $chicken->food_source = $requestData['food_source'];
            $chicken->suse_source = $requestData['suse_source'];

            $chicken->marketing_side = $requestData['marketing_side'];
            $chicken->cost = $requestData['cost'];

            $chicken->phone = $requestData['phone'];
            $chicken->email = $requestData['email'];


            $chicken->update($requestData);

            DB::commit();
            toastr()->success(__('Admin/site.updated_successfully'));
            return redirect()->route('Chickens.index');


        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['Error' => $e->getMessage()]);
        }

    }

    public function destroy($id)
    {
        $animalID = Crypt::decrypt($id);

        $chicken = ChickenProject::findorfail($animalID);

        $chicken->delete();
        toastr()->success(__('Admin/site.deleted_successfully'));
        return redirect()->route('Chickens.index');



    }

    public function bulkDelete($request) {
        try {
            DB::beginTransaction();
            if ($request->delete_select_id) {
                $delete_select_id = explode(",", $request->delete_select_id);
                foreach ($delete_select_id as $animal_ids) {

                    $animal = ChickenProject::findorfail($animal_ids);


                    ChickenProject::destroy($animal_ids);
                }
                DB::commit();

                toastr()->error(__('Admin/site.deleted_successfully'));
                return redirect()->route('Chickens.index');
            } else {
                toastr()->error(__('Admin/site.no_data_found'));
                return redirect()->route('Chickens.index');
            }
        }catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);

        }


    }// end of bulkDelete


}