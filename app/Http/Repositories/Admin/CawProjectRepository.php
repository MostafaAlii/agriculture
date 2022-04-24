<?php
namespace  App\Http\Repositories\Admin;
use App\Http\Interfaces\Admin\CawProjectInterface;
use App\Models\CawProject;
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
use Illuminate\Http\Request;
use Auth;
use Yajra\DataTables\DataTables;

class CawProjectRepository implements CawProjectInterface{

    public function index()
    {

        return view('dashboard.admin.caw_projects.index');

    }
    public function data()
    {
        $cawProjects = CawProject::with('farmer', 'village', 'adminDepartment');

        return DataTables::of($cawProjects)
            ->addColumn('record_select', 'dashboard.admin.caw_projects.data_table.record_select')
            ->addIndexColumn()
            ->editColumn('created_at', function (CawProject $cawProject) {
                return $cawProject ->created_at->diffforhumans();
            })
            ->addColumn('farmer', function (CawProject $cawProject) {
                return $cawProject ->farmer->email;
            })
            ->addColumn('village', function (CawProject $cawProject) {
                return $cawProject->village->name;
            })

            ->addColumn('actions', 'dashboard.admin.caw_projects.data_table.actions')
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
        return view('dashboard.admin.caw_projects.create',
            compact('farmers', 'admins', 'admin_dpartments', 'areas', 'villages','states'));
    }
    public function store($request)

    {
        DB::beginTransaction();
        try {
            $requestData = $request->validated();
            $animal = new CawProject();
            $animal->admin_id = Auth::user()->id;
            $animal->farmer_id = $requestData['farmer_id'];
            $animal->area_id = $requestData['area_id'];
            $animal->state_id = $requestData['state_id'];
            $animal->village_id = $requestData['village_id'];
            $animal->admin_department_id = 1;


            $animal->project_name = $requestData['project_name'];
            $animal->hall_num = $requestData['hall_num'];
            $animal->animal_count = $requestData['animal_count'];
            $animal->food_source = $requestData['food_source'];
            $animal->marketing_side = $requestData['marketing_side'];
            $animal->cost = $requestData['cost'];
            $animal->type = $requestData['type'];

            $animal->phone = $requestData['phone'];
            $animal->email = $requestData['email'];


            $animal->save($requestData);

            DB::commit();
            toastr()->success(__('Admin/site.added_successfully'));
            return redirect()->route('Animals.index');


        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['Error' => $e->getMessage()]);
        }

    }
    public function edit($id)
    {
        $animalID = Crypt::decrypt($id);
        $animal = CawProject::findorfail($animalID);
        $areas = Area::all();
        $states = State::all();
        $villages = Village::all();
        $farmers = Farmer::all();
        $admins = Admin::all();
        $admin_dpartments = AdminDepartment::all();


        return view('dashboard.admin.caw_projects.edit',
            compact('farmers', 'admin_dpartments', 'villages', 'states','areas','admins', 'animal'));
    }

    public function update($request,$id)

    {
        DB::beginTransaction();
        try {
            $requestData = $request->validated();
            $animalID = Crypt::decrypt($id);
            $animal = CawProject::findorfail($animalID);
            $animal->admin_id = Auth::user()->id;
            $animal->farmer_id = $requestData['farmer_id'];
            $animal->area_id = $requestData['area_id'];
            $animal->state_id = $requestData['state_id'];
            $animal->village_id = $requestData['village_id'];
            $animal->admin_department_id = 1;


            $animal->project_name = $requestData['project_name'];
            $animal->hall_num = $requestData['hall_num'];
            $animal->animal_count = $requestData['animal_count'];
            $animal->food_source = $requestData['food_source'];
            $animal->marketing_side = $requestData['marketing_side'];
            $animal->cost = $requestData['cost'];
            $animal->type = $requestData['type'];

            $animal->phone = $requestData['phone'];
            $animal->email = $requestData['email'];


            $animal->update($requestData);

            DB::commit();
            toastr()->success(__('Admin/site.added_successfully'));
            return redirect()->route('Animals.index');


        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['Error' => $e->getMessage()]);
        }

    }

    public function destroy($id)
    {
        $animalID = Crypt::decrypt($id);
        $animal = CawProject::findorfail($animalID);

        $animal->delete();
        toastr()->success(__('Admin/site.deleted_successfully'));
        return redirect()->route('Animals.index');



    }

    public function bulkDelete($request) {
        try {
            DB::beginTransaction();
            if ($request->delete_select_id) {
                $delete_select_id = explode(",", $request->delete_select_id);
                foreach ($delete_select_id as $animal_ids) {

                    $animal = CawProject::findorfail($animal_ids);


                    CawProject::destroy($animal_ids);
                }
                DB::commit();

                toastr()->error(__('Admin/site.deleted_successfully'));
                return redirect()->route('Animals.index');
            } else {
                toastr()->error(__('Admin/site.no_data_found'));
                return redirect()->route('Animals.index');
            }
        }catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);

        }


    }// end of bulkDelete

}