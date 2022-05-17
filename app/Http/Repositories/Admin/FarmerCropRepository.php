<?php
namespace  App\Http\Repositories\Admin;
use App\Http\Interfaces\Admin\FarmerCropInterface;
use App\Models\Farmer;
use App\Models\Admin;
use App\Models\Area;
use App\Models\State;
use App\Models\Village;
use App\Models\SummerCrop;
use App\Models\WinterCrop;
use App\Models\FarmerCrop;
use Gate;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Collection;

use App\Models\AdminDepartment;
use App\Models\LandCategory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use App\Traits\UploadT;
use Auth;
use Yajra\DataTables\DataTables;
class FarmerCropRepository implements FarmerCropInterface {
    public function index(){
        $adminID = Auth::user()->id;
        $admin = Admin::findorfail($adminID);
        $areaID = $admin->area->id;
        $area_name = $admin->area->name;
        $stateID = $admin->state->id;
        $state_name = $admin->state->name;
        return view('dashboard.admin.farmer_crops.index',compact('areaID',
            'area_name','state_name','stateID','admin'));


    }

    public function data()
    {
        $adminID = Auth::user()->id;
        $admin=Admin::findorfail($adminID);
        if($admin->type =='employee') {
            $farmerCrops = FarmerCrop::with('admin', 'farmer', 'village', 'summer_crops', 'landCategory','winter_crops')
                ->where('admin_id', '==', $admin->id)
                ->selectRaw('distinct farmer_crops.*')->get();
        }else {
            $farmerCrops = FarmerCrop::with('admin', 'farmer', 'village', 'summer_crops','winter_crops', 'landCategory')
                ->selectRaw('distinct farmer_crops.*')->get();
        }

        return DataTables::of($farmerCrops)
            ->addColumn('record_select', 'dashboard.admin.farmer_crops.data_table.record_select')
            ->addIndexColumn()
            ->editColumn('created_at', function (FarmerCrop $farmer_crop) {
                return $farmer_crop ->created_at->diffforhumans();
            })
            ->addColumn('farmer', function (FarmerCrop $farmer_crop) {
                return $farmer_crop ->farmer->email;
            })
            ->addColumn('admin', function (FarmerCrop $farmer_crop) {
                return $farmer_crop ->admin->email;
            })

            ->addColumn('village', function (FarmerCrop $farmer_crop) {
                return $farmer_crop->village->name;
            })
            ->addColumn('landCategory', function (FarmerCrop $farmer_crop) {
                return $farmer_crop->landCategory->category_name;
            })
            ->addColumn('s_name', function ($farmerCrops) {
                return implode(', ', $farmerCrops->summer_crops->pluck('name')->toArray());
            })


            ->addColumn('w_name', function ($farmerCrops) {
                return implode(', ', $farmerCrops->winter_crops->pluck('name')->toArray());
            })


            ->addColumn('actions', 'dashboard.admin.farmer_crops.data_table.actions')
            ->rawColumns(['record_select', 'actions'])
            ->toJson();

    }

    public function create() {
        $adminId = Auth::user()->id;
        $admin = Admin::findorfail($adminId);
        $areaID = $admin->area->id;
        $area_name = $admin->area->name;
        $stateID = $admin->state->id;
        $state_name = $admin->state->name;
        $villages = Village::where('state_id',$stateID)->get();
        $winter_crops = WinterCrop::all();
        $summer_crops = SummerCrop::all();

        $land_categories = LandCategory::all();

        return view('dashboard.admin.farmer_crops.create'
            ,compact('villages','land_categories','stateID',
                'winter_crops','summer_crops','state_name','area_name','areaID')
        );
    }



    public function store( $request)
    {

        DB::beginTransaction();
        try {
            $adminId = Auth::user()->id;
            $admin = Admin::findorfail($adminId);
            $areaID = $admin->area->id;
            $stateID = $admin->state->id;
            $requestData = $request->validated();
            $farmerCrop = new FarmerCrop();
            $farmerCrop->area_id = $areaID;
            $farmerCrop->state_id = $stateID;
            $farmerCrop->admin_id = $admin->id;
            $farmerCrop->farmer_id = $requestData['farmer_id'];
            $farmerCrop->village_id = $requestData['village_id'];
            $farmerCrop->land_category_id = $requestData['land_category_id'];
            $farmerCrop->phone = $requestData['phone'];
            $farmerCrop->email = $requestData['email'];

            $farmerCrop->summer_area_crop = $requestData['summer_area_crop'];
            $farmerCrop->winter_area_crop = $requestData['winter_area_crop'];
            $farmerCrop->date = $requestData['date'];


            $farmerCrop->save($requestData);
            $farmerCrop->winter_crops()->attach($request->winter_crops);
            $farmerCrop->summer_crops()->attach($request->summer_crops);

            DB::commit();
            toastr()->success(__('Admin/site.added_successfully'));
            return redirect()->route('FarmerCrops.index');


        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['Error' => $e->getMessage()]);
        }


    }


    public function edit($id)
    {
        $adminId = Auth::user()->id;
        $admin = Admin::findorfail($adminId);
        $areaID = $admin->area->id;
        $area_name = $admin->area->name;
        $stateID = $admin->state->id;
        $state_name = $admin->state->name;
        $villages = Village::where('state_id',$stateID)->get();
        $winter_crops = WinterCrop::all();
        $summer_crops = SummerCrop::all();

        $land_categories = LandCategory::all();
        $farmerCropID = Crypt::decrypt($id);

        $farmerCrop = FarmerCrop::findorfail($farmerCropID);



        return view('dashboard.admin.farmer_crops.edit', compact('winter_crops','area_name',
            'state_name','areaID','stateID','admin',
            'farmerCrop','land_categories','summer_crops','villages'));
    }


    public function update( $request,$id)
    {

        DB::beginTransaction();
        try {
            $requestData = $request->validated();
            $farmerCropID = Crypt::decrypt($id);

            $farmerCrop =  FarmerCrop::findorfail($farmerCropID);
            $adminId = Auth::user()->id;
            $admin = Admin::findorfail($adminId);
            $areaID = $admin->area->id;
            $stateID = $admin->state->id;
            $farmerCrop->admin_id = $admin->id;
            $farmerCrop->area_id = $admin->$areaID;
            $farmerCrop->state_id = $admin->$stateID;

            $farmerCrop->farmer_id = $requestData['farmer_id'];
            $farmerCrop->village_id = $requestData['village_id'];
            $farmerCrop->land_category_id = $requestData['land_category_id'];
            $farmerCrop->phone = $requestData['phone'];
            $farmerCrop->email = $requestData['email'];

            $farmerCrop->summer_area_crop = $requestData['summer_area_crop'];
            $farmerCrop->winter_area_crop = $requestData['winter_area_crop'];
            $farmerCrop->date = $requestData['date'];


            $farmerCrop->update($requestData);
            $farmerCrop->winter_crops()->sync($request->winter_crops);
            $farmerCrop->summer_crops()->sync($request->summer_crops);

            DB::commit();
            toastr()->success(__('Admin/site.added_successfully'));
            return redirect()->route('FarmerCrops.index');


        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['Error' => $e->getMessage()]);
        }


    }

    public function destroy($id)
    {
        $farmerCropID = Crypt::decrypt($id);
        $farmercrop = FarmerCrop::findorfail($farmerCropID);

        $farmercrop->delete();
            toastr()->success(__('Admin/site.deleted_successfully'));
            return redirect()->route('FarmerCrops.index');



    }

    public function bulkDelete($request) {
        try {
            DB::beginTransaction();
            if ($request->delete_select_id) {
                $delete_select_id = explode(",", $request->delete_select_id);
                foreach ($delete_select_id as $farmer_crop_ids) {

                    $farmer_crop = FarmerCrop::findorfail($farmer_crop_ids);


                    FarmerCrop::destroy($farmer_crop_ids);
                }
                DB::commit();

                toastr()->error(__('Admin/site.deleted_successfully'));
                return redirect()->route('FarmerCrops.index');
            } else {
                toastr()->error(__('Admin/site.no_data_found'));
                return redirect()->route('FarmerCrops.index');
            }
        }catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);

        }


    }// end of bulkDelete

    public function statistics(){
        $adminID = Auth::user()->id;
        $admin=Admin::findorfail($adminID);

        if($admin->type == 'employee' ) {
            $statistics = FarmerCrop::select('area_translations.name AS Area',
                'state_translations.name AS State',
                'village_translations.name AS Village', 'farmers.email AS email_farmer',
                'farmer_crops.summer_area_crop As summer_area_crop',
                'farmer_crops.winter_area_crop As winter_area_crop',
                'farmer_crops.date As date','land_category_translations.category_name As category_name' )


                ->join('area_translations', 'farmer_crops.area_id', '=', 'area_translations.id')
                ->join('state_translations', 'farmer_crops.state_id', '=', 'state_translations.id')
                ->join('village_translations', 'farmer_crops.village_id', '=', 'village_translations.id')
                ->join('land_category_translations', 'farmer_crops.land_category_id', '=', 'land_category_translations.id')

                ->join('farmers', 'farmer_crops.farmer_id', '=', 'farmers.id')
                ->where('farmer_services.admin_id', $admin->id)

                ->get();
        }
        else if($admin->type == 'admin' ){
            $statistics = FarmerCrop::select('area_translations.name AS Area',
                'state_translations.name AS State',
                'village_translations.name AS Village', 'farmers.email AS email_farmer',
                'farmer_crops.summer_area_crop As summer_area_crop',
                'farmer_crops.winter_area_crop As winter_area_crop',
                'farmer_crops.date As date','land_category_translations.category_name As category_name')


                ->join('area_translations', 'farmer_crops.area_id', '=', 'area_translations.id')
                ->join('state_translations', 'farmer_crops.state_id', '=', 'state_translations.id')
                ->join('village_translations', 'farmer_crops.village_id', '=', 'village_translations.id')
                ->join('land_category_translations', 'farmer_crops.land_category_id', '=', 'land_category_translations.id')
                ->join('farmers', 'farmer_crops.farmer_id', '=', 'farmers.id')

//                ->GroupBy('Area', 'State', 'Village', 'email')
                ->get();
        }

        return view('dashboard.admin.farmer_crops.statistics',compact('statistics'));

    }



}