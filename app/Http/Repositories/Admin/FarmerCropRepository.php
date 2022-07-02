<?php

namespace App\Http\Repositories\Admin;

use App\Http\Interfaces\Admin\FarmerCropInterface;
use App\Models\Farmer;
use App\Models\Admin;
use App\Models\Area;
use App\Models\State;
use App\Models\Village;
use App\Models\AreaTranslation;
use App\Models\StateTranslation;
use App\Models\VillageTranslation;
use App\Models\LandCategoryTranslation;

use App\Models\SummerCrop;
use App\Models\WinterCrop;
use App\Models\FarmerCrop;
use Gate;

use App\Models\LandCategory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;

use Auth;
use Yajra\DataTables\DataTables;

class FarmerCropRepository implements FarmerCropInterface
{
    public function index()
    {
        $adminID = Auth::user()->id;
        $admin = Admin::findorfail($adminID);
        if ($admin->area == Null && $admin->state == null) {
            toastr()->error(__('Admin/animals.index-wrong'));

            return redirect()->back();
        } else {
            $areaID = $admin->area->id;
            $area_name = $admin->area->name;
            $stateID = $admin->state->id;
            $state_name = $admin->state->name;
            return view('dashboard.admin.farmer_crops.index', compact('areaID',
                'area_name', 'state_name', 'stateID', 'admin'));
        }


    }

    public function data()
    {
        $adminID = Auth::user()->id;
        $admin = Admin::findorfail($adminID);
        if ($admin->type == 'employee') {
            $farmerCrops = FarmerCrop::with('admin', 'farmer', 'village', 'summer_crops', 'landCategory', 'winter_crops')
                ->where('admin_id', $admin->id)
                ->selectRaw('distinct farmer_crops.*')->get();
        } else {
            $farmerCrops = FarmerCrop::with('admin', 'farmer', 'village', 'summer_crops', 'winter_crops', 'landCategory')
                ->selectRaw('distinct farmer_crops.*')->get();
        }

        return DataTables::of($farmerCrops)
            ->addColumn('record_select', 'dashboard.admin.farmer_crops.data_table.record_select')
            ->addIndexColumn()
            ->editColumn('created_at', function (FarmerCrop $farmer_crop) {
                return $farmer_crop->created_at->diffforhumans();
            })
            ->addColumn('farmer', function (FarmerCrop $farmer_crop) {
                return $farmer_crop->farmer->email;
            })
            ->addColumn('admin', function (FarmerCrop $farmer_crop) {
                return $farmer_crop->admin->email;
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

    public function create()
    {
        $adminId = Auth::user()->id;
        $admin = Admin::findorfail($adminId);
        $areaID = $admin->area->id;
        $area_name = $admin->area->name;
        $stateID = $admin->state->id;
        $state_name = $admin->state->name;
        $villages = Village::where('state_id', $stateID)->get();
        $winter_crops = WinterCrop::all();
        $summer_crops = SummerCrop::all();

        $land_categories = LandCategory::all();

        return view('dashboard.admin.farmer_crops.create'
            , compact('villages', 'land_categories', 'stateID', 'adminId',
                'winter_crops', 'summer_crops', 'state_name', 'area_name', 'areaID')
        );
    }


    public function store($request)
    {
        DB::beginTransaction();
        try {
            $requestData = $request->validated();
//            $farmerCrop = new FarmerCrop();
            $adminId = Auth::user()->id;
            $admin = Admin::findorfail($adminId);
            $farmerCrop = FarmerCrop::create([
                'admin_id' => $requestData['admin_id'],
                'area_id' => $requestData['area_id'],
                'state_id' => $requestData['state_id'],
                'admin_id' => $admin->id,
                'farmer_id' => $requestData['farmer_id'],
                'village_id' => $requestData['village_id'],
                'land_category_id' => $requestData['land_category_id'],

                'summer_area_crop' => $requestData['summer_area_crop'],
                'winter_area_crop' => $requestData['winter_area_crop'],
                'date' => $requestData['date']


            ]);

//            $farmerCrop->admin_id = $requestData['admin_id'];
//            $farmerCrop->area_id = $requestData['area_id'];
//            $farmerCrop->state_id = $requestData['state_id'];
//
//
//            $farmerCrop->admin_id = $admin->id;
//            $farmerCrop->farmer_id = $requestData['farmer_id'];
//            $farmerCrop->village_id = $requestData['village_id'];
//            $farmerCrop->land_category_id = $requestData['land_category_id'];
//
//            $farmerCrop->summer_area_crop = $requestData['summer_area_crop'];
//            $farmerCrop->winter_area_crop = $requestData['winter_area_crop'];
//            $farmerCrop->date = $requestData['date'];
//
//
//            $farmerCrop->save($requestData);
            $farmerCrop->winter_crops()->attach($request->winter_crops);
            $farmerCrop->summer_crops()->attach($request->summer_crops);

            DB::commit();
            toastr()->success(__('Admin/site.added_successfully'));
            return redirect()->route('FarmerCrops.index');


        } catch (\Exception $e) {
            DB::rollBack();
            toastr()->error(__('Admin/attributes.add_wrong'));

            return redirect()->back();
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
        $villages = Village::where('state_id', $stateID)->get();
        $winter_crops = WinterCrop::all();
        $summer_crops = SummerCrop::all();

        $land_categories = LandCategory::all();
        $farmerCropID = Crypt::decrypt($id);

        $farmerCrop = FarmerCrop::findorfail($farmerCropID);


        return view('dashboard.admin.farmer_crops.edit', compact('winter_crops', 'area_name', 'areaID', 'stateID',
            'state_name', 'areaID', 'stateID', 'admin', 'adminId',
            'farmerCrop', 'land_categories', 'summer_crops', 'villages'));
    }


    public function update($request, $id)
    {

        DB::beginTransaction();
        try {

            $requestData = $request->validated();
            $farmerCropID = Crypt::decrypt($id);

            $farmerCrop = FarmerCrop::findorfail($farmerCropID);
            $farmerCrop->admin_id = $requestData['admin_id'];
            $farmerCrop->area_id = $requestData['area_id'];
            $farmerCrop->state_id = $requestData['state_id'];

            $farmerCrop->farmer_id = $requestData['farmer_id'];
            $farmerCrop->village_id = $requestData['village_id'];
            $farmerCrop->land_category_id = $requestData['land_category_id'];

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
            toastr()->error(__('Admin/attributes.edit_wrong'));

            return redirect()->back();
        }


    }

    public function destroy($id)
    {
        try {
            $farmerCropID = Crypt::decrypt($id);
            $farmercrop = FarmerCrop::findorfail($farmerCropID);
            $farmercrop->winter_crops()->detach();
            $farmercrop->summer_crops()->detach();

            $farmercrop->delete();
            toastr()->success(__('Admin/site.deleted_successfully'));
            return redirect()->route('FarmerCrops.index');

        } catch (\Exception $e) {
            DB::rollBack();
            toastr()->error(__('Admin/attributes.delete_wrong'));

            return redirect()->back();
        }


    }

    public function bulkDelete($request)
    {
        try {
            DB::beginTransaction();
            if ($request->delete_select_id) {
                $delete_select_id = explode(",", $request->delete_select_id);
                foreach ($delete_select_id as $farmer_crop_ids) {

                    $farmer_crop = FarmerCrop::findorfail($farmer_crop_ids);
                    $farmer_crop->winter_crops()->detach();
                    $farmer_crop->summer_crops()->detach();

                    $farmer_crop->delete();
                }
                DB::commit();

                toastr()->error(__('Admin/site.deleted_successfully'));
                return redirect()->route('FarmerCrops.index');
            } else {
                toastr()->error(__('Admin/site.no_data_found'));
                return redirect()->route('FarmerCrops.index');
            }
        } catch (\Exception $e) {
            DB::rollBack();
            toastr()->error(__('Admin/attributes.delete_wrong'));

            return redirect()->back();

        }


    }// end of bulkDelete

    public function statistics_index()
    {
        $adminID = Auth::user()->id;
        $admin = Admin::findorfail($adminID);
        $land_categories = LandCategory::all();
        return view('dashboard.admin.farmer_crops.statistics', compact('admin', 'land_categories'));

    }

    public function statistics($request)
    {
        $validated = $request->validate([
            'area_id' => 'sometimes|nullable|exists:areas,id',
            'state_id' => 'sometimes|nullable|exists:states,id',
            'village_id' => 'sometimes|nullable|exists:villages,id',
            'land_category_id' => 'sometimes|nullable|exists:land_categories,id',

            'start_date' => 'sometimes|nullable|date|before:end_date',
            'end_date' => 'sometimes|nullable|date|after:start_date',
        ], [
            'area_id.exists' => trans('Admin/validation.exists'),
            'start_date.date' => trans('Admin/validation.date'),
            'start_date.before' => trans('Admin/validation.before'),
            'end_date.date' => trans('Admin/validation.date'),
            'end_date.after' => trans('Admin/validation.after'),
        ]);

        $adminID = Auth::user()->id;
        $admin = Admin::findorfail($adminID);
        $land_categories = LandCategory::all();

        if (!empty($request->area_id)) {
            $area_name = AreaTranslation::where('area_id', '=', $request->area_id)->pluck('name');

        }
        if (!empty($request->state_id)) {
            $state_name = StateTranslation::where('state_id', '=', $request->state_id)->pluck('name');
        }
        if (!empty($request->village_id)) {
            $village_name = VillageTranslation::where('village_id', '=', $request->village_id)->pluck('name');
        }
        if ($request->land_category_id != null) {
            $land_category_name = LandCategoryTranslation::where('land_category_id', '=', $request->land_category_id)->pluck('category_name');
        }


        $start_date = (!empty($_GET["start_date"])) ? ($_GET["start_date"]) : ('');
        $end_date = (!empty($_GET["end_date"])) ? ($_GET["end_date"]) : ('');
        $state_id = (!empty($_GET["state_id"])) ? ($_GET["state_id"]) : ('');
        $area_id = (!empty($_GET["area_id"])) ? ($_GET["area_id"]) : ('');

        $latests = \DB::table('farmer_crops')->orderBy('date', 'desc')->first();
        $oldest = \DB::table('farmer_crops')->orderBy('date', 'asc')->first();


        if ($admin->type == 'admin') {
            if ($request->area_id != null && $request->state_id != null &&
                $request->village_id != null && $request->land_category_id != null &&
                $request->start_date && $request->end_date) {

                $farmercropsQuery = FarmerCrop::whereRaw("date(farmer_crops.date) >= '" . $request->start_date . "'
             AND date(farmer_crops.date) <= '" . $request->end_date . "'");
                $statistics = $farmercropsQuery->select('area_translations.name AS Area',
                    'state_translations.name AS State',
                    'village_translations.name AS Village', 'farmers.firstname AS farmer',
                    DB::raw('SUM(farmer_crops.winter_area_crop) As winter_area_crop'),
                    DB::raw('SUM(farmer_crops.summer_area_crop) As summer_area_crop'),

                    'farmer_crops.date As date', 'land_category_translations.category_name As category_name')
                    ->join('area_translations', 'farmer_crops.area_id', '=', 'area_translations.id')
                    ->join('state_translations', 'farmer_crops.state_id', '=', 'state_translations.id')
                    ->join('village_translations', 'farmer_crops.village_id', '=', 'village_translations.id')
                    ->join('land_category_translations', 'farmer_crops.land_category_id', '=', 'land_category_translations.id')
                    ->join('farmers', 'farmer_crops.farmer_id', '=', 'farmers.id')
                    ->where('area_translations.name', $area_name)
                    ->where('state_translations.name', $state_name)
                    ->where('village_translations.name', $village_name)
                    ->where('land_category_translations.category_name', $land_category_name)
                    ->GroupBy('Area', 'State', 'Village', 'farmer', 'date', 'category_name')
                    ->get();
                return view('dashboard.admin.farmer_crops.statistics', compact('statistics', 'admin', 'land_categories'));
            } elseif ($request->start_date && $request->end_date &&
                $request->area_id != null && $request->state_id == null && $request->village_id == null && $request->land_category_id != null) {

                $farmercropsQuery = FarmerCrop::whereRaw("date(farmer_crops.date) >= '" . $request->start_date . "'
             AND date(farmer_crops.date) <= '" . $request->end_date . "'");

                $statistics = $farmercropsQuery->select('area_translations.name AS Area',
                    'state_translations.name AS State',
                    'village_translations.name AS Village', 'farmers.firstname AS farmer',
                    DB::raw('SUM(farmer_crops.winter_area_crop) As winter_area_crop'),
                    DB::raw('SUM(farmer_crops.summer_area_crop) As summer_area_crop'),

                    'farmer_crops.date As date', 'land_category_translations.category_name As category_name')
                    ->join('area_translations', 'farmer_crops.area_id', '=', 'area_translations.id')
                    ->join('state_translations', 'farmer_crops.state_id', '=', 'state_translations.id')
                    ->join('village_translations', 'farmer_crops.village_id', '=', 'village_translations.id')
                    ->join('land_category_translations', 'farmer_crops.land_category_id', '=', 'land_category_translations.id')
                    ->join('farmers', 'farmer_crops.farmer_id', '=', 'farmers.id')
                    ->where('area_translations.name', $area_name)
                    ->where('land_category_translations.category_name', $land_category_name)
                    ->GroupBy('Area', 'State', 'Village', 'farmer', 'date', 'category_name')
                    ->get();
                return view('dashboard.admin.farmer_crops.statistics', compact('statistics', 'admin', 'land_categories'));
            } elseif ($request->start_date != null && $request->end_date != null &&
                $request->area_id != null && $request->state_id != null && $request->village_id != null
                && $request->land_category_id == null) {

                $farmercropsQuery = FarmerCrop::whereRaw("date(farmer_crops.date) >= '" . $request->start_date . "'
             AND date(farmer_crops.date) <= '" . $request->end_date . "'");

                $statistics = $farmercropsQuery->select('area_translations.name AS Area',
                    'state_translations.name AS State',
                    'village_translations.name AS Village', 'farmers.firstname AS farmer',
                    DB::raw('SUM(farmer_crops.winter_area_crop) As winter_area_crop'),
                    DB::raw('SUM(farmer_crops.summer_area_crop) As summer_area_crop'),

                    'farmer_crops.date As date', 'land_category_translations.category_name As category_name')
                    ->join('area_translations', 'farmer_crops.area_id', '=', 'area_translations.id')
                    ->join('state_translations', 'farmer_crops.state_id', '=', 'state_translations.id')
                    ->join('village_translations', 'farmer_crops.village_id', '=', 'village_translations.id')
                    ->join('land_category_translations', 'farmer_crops.land_category_id', '=', 'land_category_translations.id')
                    ->join('farmers', 'farmer_crops.farmer_id', '=', 'farmers.id')
                    ->where('area_translations.name', $area_name)
                    ->where('state_translations.name', $state_name)
                    ->where('village_translations.name', $village_name)
                    ->GroupBy('Area', 'State', 'Village', 'farmer', 'date', 'category_name')
                    ->get();
                return view('dashboard.admin.farmer_crops.statistics', compact('statistics', 'admin', 'land_categories'));
            } elseif ($request->start_date == null && $request->end_date == null &&
                $request->area_id != null && $request->state_id != null && $request->village_id != null && $request->land_category_id != null) {

                $statistics = FarmerCrop::select('area_translations.name AS Area',
                    'state_translations.name AS State',
                    'village_translations.name AS Village', 'farmers.firstname AS farmer',
                    DB::raw('SUM(farmer_crops.winter_area_crop) As winter_area_crop'),
                    DB::raw('SUM(farmer_crops.summer_area_crop) As summer_area_crop'),

                    'farmer_crops.date As date', 'land_category_translations.category_name As category_name')
                    ->join('area_translations', 'farmer_crops.area_id', '=', 'area_translations.id')
                    ->join('state_translations', 'farmer_crops.state_id', '=', 'state_translations.id')
                    ->join('village_translations', 'farmer_crops.village_id', '=', 'village_translations.id')
                    ->join('land_category_translations', 'farmer_crops.land_category_id', '=', 'land_category_translations.id')
                    ->join('farmers', 'farmer_crops.farmer_id', '=', 'farmers.id')
                    ->where('area_translations.name', $area_name)
                    ->where('state_translations.name', $state_name)
                    ->where('village_translations.name', $village_name)
                    ->where('land_category_translations.category_name', $land_category_name)
                    ->GroupBy('Area', 'State', 'Village', 'farmer', 'date', 'category_name')
                    ->get();
                return view('dashboard.admin.farmer_crops.statistics', compact('statistics', 'admin', 'land_categories'));

            } elseif ($request->start_date == null && $request->end_date == null &&
                $request->area_id != null && $request->state_id == null && $request->village_id == null
                && $request->land_category_id == null) {

                $statistics = FarmerCrop::select('area_translations.name AS Area',
                    'state_translations.name AS State',
                    'village_translations.name AS Village', 'farmers.firstname AS farmer',
                    DB::raw('SUM(farmer_crops.winter_area_crop) As winter_area_crop'),
                    DB::raw('SUM(farmer_crops.summer_area_crop) As summer_area_crop'),

                    'farmer_crops.date As date', 'land_category_translations.category_name As category_name')
                    ->join('area_translations', 'farmer_crops.area_id', '=', 'area_translations.id')
                    ->join('state_translations', 'farmer_crops.state_id', '=', 'state_translations.id')
                    ->join('village_translations', 'farmer_crops.village_id', '=', 'village_translations.id')
                    ->join('land_category_translations', 'farmer_crops.land_category_id', '=', 'land_category_translations.id')
                    ->join('farmers', 'farmer_crops.farmer_id', '=', 'farmers.id')
                    ->where('area_translations.name', $area_name)
                    ->GroupBy('Area', 'State', 'Village', 'farmer', 'date', 'category_name')
                    ->get();
                return view('dashboard.admin.farmer_crops.statistics', compact('statistics', 'admin', 'land_categories'));

            } elseif ($request->start_date == null && $request->end_date == null &&
                $request->area_id != null && $request->state_id == null && $request->village_id == null
                && $request->land_category_id != null) {

                $statistics = FarmerCrop::select('area_translations.name AS Area',
                    'state_translations.name AS State',
                    'village_translations.name AS Village', 'farmers.firstname AS farmer',
                    DB::raw('SUM(farmer_crops.winter_area_crop) As winter_area_crop'),
                    DB::raw('SUM(farmer_crops.summer_area_crop) As summer_area_crop'),

                    'farmer_crops.date As date', 'land_category_translations.category_name As category_name')
                    ->join('area_translations', 'farmer_crops.area_id', '=', 'area_translations.id')
                    ->join('state_translations', 'farmer_crops.state_id', '=', 'state_translations.id')
                    ->join('village_translations', 'farmer_crops.village_id', '=', 'village_translations.id')
                    ->join('land_category_translations', 'farmer_crops.land_category_id', '=', 'land_category_translations.id')
                    ->join('farmers', 'farmer_crops.farmer_id', '=', 'farmers.id')
                    ->where('area_translations.name', $area_name)
                    ->where('land_category_translations.category_name', $land_category_name)
                    ->GroupBy('Area', 'State', 'Village', 'farmer', 'date', 'category_name')
                    ->get();
                return view('dashboard.admin.farmer_crops.statistics', compact('statistics', 'admin', 'land_categories'));

            } elseif ($request->start_date == null && $request->end_date == null &&
                $request->area_id != null && $request->state_id != null && $request->village_id == null
                && $request->land_category_id == null) {

                $statistics = FarmerCrop::select('area_translations.name AS Area',
                    'state_translations.name AS State',
                    'village_translations.name AS Village', 'farmers.firstname AS farmer',
                    DB::raw('SUM(farmer_crops.winter_area_crop) As winter_area_crop'),
                    DB::raw('SUM(farmer_crops.summer_area_crop) As summer_area_crop'),

                    'farmer_crops.date As date', 'land_category_translations.category_name As category_name')
                    ->join('area_translations', 'farmer_crops.area_id', '=', 'area_translations.id')
                    ->join('state_translations', 'farmer_crops.state_id', '=', 'state_translations.id')
                    ->join('village_translations', 'farmer_crops.village_id', '=', 'village_translations.id')
                    ->join('land_category_translations', 'farmer_crops.land_category_id', '=', 'land_category_translations.id')
                    ->join('farmers', 'farmer_crops.farmer_id', '=', 'farmers.id')
                    ->where('area_translations.name', $area_name)
                    ->where('state_translations.name', $state_name)
                    ->GroupBy('Area', 'State', 'Village', 'farmer', 'date', 'category_name')
                    ->get();
                return view('dashboard.admin.farmer_crops.statistics', compact('statistics', 'admin', 'land_categories'));

            } elseif ($request->start_date == null && $request->end_date == null &&
                $request->area_id == null && $request->state_id == null && $request->village_id == null
                && $request->land_category_id == null) {

                $statistics = FarmerCrop::select('area_translations.name AS Area',
                    'state_translations.name AS State',
                    'village_translations.name AS Village', 'farmers.firstname AS farmer',
                    DB::raw('SUM(farmer_crops.winter_area_crop) As winter_area_crop'),
                    DB::raw('SUM(farmer_crops.summer_area_crop) As summer_area_crop'),

                    'farmer_crops.date As date', 'land_category_translations.category_name As category_name')
                    ->join('area_translations', 'farmer_crops.area_id', '=', 'area_translations.id')
                    ->join('state_translations', 'farmer_crops.state_id', '=', 'state_translations.id')
                    ->join('village_translations', 'farmer_crops.village_id', '=', 'village_translations.id')
                    ->join('land_category_translations', 'farmer_crops.land_category_id', '=', 'land_category_translations.id')
                    ->join('farmers', 'farmer_crops.farmer_id', '=', 'farmers.id')
                    ->GroupBy('Area', 'State', 'Village', 'farmer', 'date', 'category_name')
                    ->get();
                return view('dashboard.admin.farmer_crops.statistics', compact('statistics', 'admin', 'land_categories'));

            } elseif ($request->start_date == null && $request->end_date == null &&
                $request->area_id != null && $request->state_id != null && $request->village_id == null
                && $request->land_category_id != null) {

                $statistics = FarmerCrop::select('area_translations.name AS Area',
                    'state_translations.name AS State',
                    'village_translations.name AS Village', 'farmers.firstname AS farmer',
                    DB::raw('SUM(farmer_crops.winter_area_crop) As winter_area_crop'),
                    DB::raw('SUM(farmer_crops.summer_area_crop) As summer_area_crop'),

                    'farmer_crops.date As date', 'land_category_translations.category_name As category_name')
                    ->join('area_translations', 'farmer_crops.area_id', '=', 'area_translations.id')
                    ->join('state_translations', 'farmer_crops.state_id', '=', 'state_translations.id')
                    ->join('village_translations', 'farmer_crops.village_id', '=', 'village_translations.id')
                    ->join('land_category_translations', 'farmer_crops.land_category_id', '=', 'land_category_translations.id')
                    ->join('farmers', 'farmer_crops.farmer_id', '=', 'farmers.id')
                    ->where('area_translations.name', $area_name)
                    ->where('state_translations.name', $state_name)
                    ->where('land_category_translations.category_name', $land_category_name)
                    ->GroupBy('Area', 'State', 'Village', 'farmer', 'date', 'category_name')
                    ->get();
                return view('dashboard.admin.farmer_crops.statistics', compact('statistics', 'admin', 'land_categories'));

            } elseif ($request->start_date == null && $request->end_date == null &&
                $request->area_id != null && $request->state_id != null && $request->village_id != null
                && $request->land_category_id == null) {

                $statistics = FarmerCrop::select('area_translations.name AS Area',
                    'state_translations.name AS State',
                    'village_translations.name AS Village', 'farmers.firstname AS farmer',
                    DB::raw('SUM(farmer_crops.winter_area_crop) As winter_area_crop'),
                    DB::raw('SUM(farmer_crops.summer_area_crop) As summer_area_crop'),

                    'farmer_crops.date As date', 'land_category_translations.category_name As category_name')
                    ->join('area_translations', 'farmer_crops.area_id', '=', 'area_translations.id')
                    ->join('state_translations', 'farmer_crops.state_id', '=', 'state_translations.id')
                    ->join('village_translations', 'farmer_crops.village_id', '=', 'village_translations.id')
                    ->join('land_category_translations', 'farmer_crops.land_category_id', '=', 'land_category_translations.id')
                    ->join('farmers', 'farmer_crops.farmer_id', '=', 'farmers.id')
                    ->where('area_translations.name', $area_name)
                    ->where('state_translations.name', $state_name)
                    ->where('village_translations.name', $village_name)
                    ->GroupBy('Area', 'State', 'Village', 'farmer', 'date', 'category_name')
                    ->get();
                return view('dashboard.admin.farmer_crops.statistics', compact('statistics', 'admin', 'land_categories'));

            } elseif ($request->start_date == null && $request->end_date == null &&
                $request->area_id != null && $request->state_id != null && $request->village_id != null
                && $request->land_category_id != null) {

                $statistics = FarmerCrop::select('area_translations.name AS Area',
                    'state_translations.name AS State',
                    'village_translations.name AS Village', 'farmers.firstname AS farmer',
                    DB::raw('SUM(farmer_crops.winter_area_crop) As winter_area_crop'),
                    DB::raw('SUM(farmer_crops.summer_area_crop) As summer_area_crop'),

                    'farmer_crops.date As date', 'land_category_translations.category_name As category_name')
                    ->join('area_translations', 'farmer_crops.area_id', '=', 'area_translations.id')
                    ->join('state_translations', 'farmer_crops.state_id', '=', 'state_translations.id')
                    ->join('village_translations', 'farmer_crops.village_id', '=', 'village_translations.id')
                    ->join('land_category_translations', 'farmer_crops.land_category_id', '=', 'land_category_translations.id')
                    ->join('farmers', 'farmer_crops.farmer_id', '=', 'farmers.id')
                    ->where('area_translations.name', $area_name)
                    ->where('state_translations.name', $state_name)
                    ->where('village_translations.name', $village_name)
                    ->where('land_category_translations.category_name', $land_category_name)
                    ->GroupBy('Area', 'State', 'Village', 'farmer', 'date', 'category_name')
                    ->get();
                return view('dashboard.admin.farmer_crops.statistics', compact('statistics', 'admin', 'land_categories'));

            }

        } elseif ($admin->type == 'employee') {
            if ($request->start_date != null && $request->end_date != null &&
                $request->village_id != null && $request->land_category_id != null) {
                $farmercropsQuery = FarmerCrop::whereRaw("date(farmer_crops.date) >= '" . $request->start_date . "'
             AND date(farmer_crops.date) <= '" . $request->end_date . "'");

                $statistics = $farmercropsQuery->select('area_translations.name AS Area',
                    'state_translations.name AS State',
                    'village_translations.name AS Village', 'farmers.firstname AS farmer',
                    DB::raw('SUM(farmer_crops.winter_area_crop) As winter_area_crop'),
                    DB::raw('SUM(farmer_crops.summer_area_crop) As summer_area_crop'),

                    'farmer_crops.date As date', 'land_category_translations.category_name As category_name')
                    ->join('area_translations', 'farmer_crops.area_id', '=', 'area_translations.id')
                    ->join('state_translations', 'farmer_crops.state_id', '=', 'state_translations.id')
                    ->join('village_translations', 'farmer_crops.village_id', '=', 'village_translations.id')
                    ->join('land_category_translations', 'farmer_crops.land_category_id', '=', 'land_category_translations.id')
                    ->join('farmers', 'farmer_crops.farmer_id', '=', 'farmers.id')
                    ->where('farmer_crops.admin_id', $admin->id)
                    ->where('area_translations.area_id', $area_id)
                    ->where('state_translations.state_id', $state_id)
                    ->where('village_translations.name', $village_name)
                    ->where('land_category_translations.category_name', $land_category_name)
                    ->GroupBy('Area', 'State', 'Village', 'farmer', 'date', 'category_name')
                    ->get();
                return view('dashboard.admin.farmer_crops.statistics', compact('statistics', 'admin', 'land_categories'));
            } elseif ($request->start_date != null && $request->end_date != null &&
                $request->village_id == null && $request->land_category_id == null) {
                $farmercropsQuery = FarmerCrop::whereRaw("date(farmer_crops.date) >= '" . $request->start_date . "'
             AND date(farmer_crops.date) <= '" . $request->end_date . "'");


                $statistics = $farmercropsQuery->select('area_translations.name AS Area',
                    'state_translations.name AS State',
                    'village_translations.name AS Village', 'farmers.firstname AS farmer',
                    DB::raw('SUM(farmer_crops.winter_area_crop) As winter_area_crop'),
                    DB::raw('SUM(farmer_crops.summer_area_crop) As summer_area_crop'),

                    'farmer_crops.date As date', 'land_category_translations.category_name As category_name')
                    ->join('area_translations', 'farmer_crops.area_id', '=', 'area_translations.id')
                    ->join('state_translations', 'farmer_crops.state_id', '=', 'state_translations.id')
                    ->join('village_translations', 'farmer_crops.village_id', '=', 'village_translations.id')
                    ->join('land_category_translations', 'farmer_crops.land_category_id', '=', 'land_category_translations.id')
                    ->join('farmers', 'farmer_crops.farmer_id', '=', 'farmers.id')
                    ->where('farmer_crops.admin_id', $admin->id)
                    ->where('area_translations.area_id', $area_id)
                    ->where('state_translations.state_id', $state_id)
                    ->where('village_translations.name', $village_name)
                    ->GroupBy('Area', 'State', 'Village', 'farmer', 'date', 'category_name')
                    ->get();
                return view('dashboard.admin.farmer_crops.statistics', compact('statistics', 'admin', 'land_categories'));
            } elseif ($request->village_id != null && $request->land_category_id == null) {

                $statistics = FarmerCrop::select('area_translations.name AS Area',
                    'state_translations.name AS State',
                    'village_translations.name AS Village', 'farmers.firstname AS farmer',
                    DB::raw('SUM(farmer_crops.winter_area_crop) As winter_area_crop'),
                    DB::raw('SUM(farmer_crops.summer_area_crop) As summer_area_crop'),

                    'farmer_crops.date As date', 'land_category_translations.category_name As category_name')
                    ->join('area_translations', 'farmer_crops.area_id', '=', 'area_translations.id')
                    ->join('state_translations', 'farmer_crops.state_id', '=', 'state_translations.id')
                    ->join('village_translations', 'farmer_crops.village_id', '=', 'village_translations.id')
                    ->join('land_category_translations', 'farmer_crops.land_category_id', '=', 'land_category_translations.id')
                    ->join('farmers', 'farmer_crops.farmer_id', '=', 'farmers.id')
                    ->where('farmer_crops.admin_id', $admin->id)
                    ->where('area_translations.area_id', $area_id)
                    ->where('state_translations.state_id', $state_id)
                    ->where('village_translations.name', $village_name)
                    ->GroupBy('Area', 'State', 'Village', 'farmer', 'date', 'category_name')
                    ->get();
                return view('dashboard.admin.farmer_crops.statistics', compact('statistics', 'admin', 'land_categories'));
            } elseif ($request->village_id == null && $request->land_category_id == null) {

                $statistics = FarmerCrop::select('area_translations.name AS Area',
                    'state_translations.name AS State',
                    'village_translations.name AS Village', 'farmers.firstname AS farmer',
                    DB::raw('SUM(farmer_crops.winter_area_crop) As winter_area_crop'),
                    DB::raw('SUM(farmer_crops.summer_area_crop) As summer_area_crop'),

                    'farmer_crops.date As date', 'land_category_translations.category_name As category_name')
                    ->join('area_translations', 'farmer_crops.area_id', '=', 'area_translations.id')
                    ->join('state_translations', 'farmer_crops.state_id', '=', 'state_translations.id')
                    ->join('village_translations', 'farmer_crops.village_id', '=', 'village_translations.id')
                    ->join('land_category_translations', 'farmer_crops.land_category_id', '=', 'land_category_translations.id')
                    ->join('farmers', 'farmer_crops.farmer_id', '=', 'farmers.id')
                    ->where('farmer_crops.admin_id', $admin->id)
                    ->where('area_translations.area_id', $area_id)
                    ->where('state_translations.state_id', $state_id)
                    ->GroupBy('Area', 'State', 'Village', 'farmer', 'date', 'category_name')
                    ->get();
                return view('dashboard.admin.farmer_crops.statistics', compact('statistics', 'admin', 'land_categories'));
            } elseif ($request->village_id != null && $request->land_category_id != null) {

                $statistics = FarmerCrop::select('area_translations.name AS Area',
                    'state_translations.name AS State',
                    'village_translations.name AS Village', 'farmers.firstname AS farmer',
                    DB::raw('SUM(farmer_crops.winter_area_crop) As winter_area_crop'),
                    DB::raw('SUM(farmer_crops.summer_area_crop) As summer_area_crop'),

                    'farmer_crops.date As date', 'land_category_translations.category_name As category_name')
                    ->join('area_translations', 'farmer_crops.area_id', '=', 'area_translations.id')
                    ->join('state_translations', 'farmer_crops.state_id', '=', 'state_translations.id')
                    ->join('village_translations', 'farmer_crops.village_id', '=', 'village_translations.id')
                    ->join('land_category_translations', 'farmer_crops.land_category_id', '=', 'land_category_translations.id')
                    ->join('farmers', 'farmer_crops.farmer_id', '=', 'farmers.id')
                    ->where('farmer_crops.admin_id', $admin->id)
                    ->where('area_translations.area_id', $area_id)
                    ->where('state_translations.state_id', $state_id)
                    ->where('village_translations.name', $village_name)
                    ->where('land_category_translations.category_name', $land_category_name)
                    ->GroupBy('Area', 'State', 'Village', 'farmer', 'date', 'category_name')
                    ->get();
                return view('dashboard.admin.farmer_crops.statistics', compact('statistics', 'admin', 'land_categories'));
            }
        }


    }


}