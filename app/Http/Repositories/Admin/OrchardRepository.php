<?php

namespace App\Http\Repositories\Admin;

use App\Models\AreaTranslation;
use App\Models\LandCategoryTranslation;
use App\Models\Orchard;
use App\Models\Farmer;
use App\Models\Admin;
use App\Models\Area;
use App\Models\State;
use App\Models\LandCategory;

use App\Models\StateTranslation;
use App\Models\TreeTranslation;
use App\Models\Village;
use App\Models\Unit;

use App\Models\Tree;

use App\Models\VillageTranslation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use App\Traits\UploadT;
use App\Http\Interfaces\Admin\OrchardInterface;
use Illuminate\Http\Request;
use Auth;
use Yajra\DataTables\DataTables;


class OrchardRepository implements OrchardInterface
{
    use UploadT;

    public function index()
    {
        $adminID = Auth::user()->id;
        $admin = Admin::findorfail($adminID);
        if ($admin->area == Null && $admin->state == null) {
            toastr()->error(__('Admin/services.index-wrong'));

            return redirect()->back();
        } else {
            $areaID = $admin->area->id;
            $area_name = $admin->area->name;
            $stateID = $admin->state->id;
            $state_name = $admin->state->name;
            return view('dashboard.admin.orchards.index',
                compact('admin', 'areaID', 'area_name', 'stateID', 'state_name'));
        }


    }

    public function data()
    {
        $adminID = Auth::user()->id;
        $admin = Admin::findorfail($adminID);
        if ($admin->type == 'employee') {
            $orchards = Orchard::query('admin', 'farmer', 'village', 'trees', 'landCategory', 'area', 'state')
                ->where('admin_id', $admin->id)
                ->selectRaw('distinct orchards.*')->get();
        } else {
            $orchards = Orchard::query( 'farmer', 'village', 'trees', 'landCategory', 'area', 'state')
                ->selectRaw('distinct orchards.*')
                ->get();
        }
        return DataTables::of($orchards)
            ->addColumn('record_select', 'dashboard.admin.orchards.data_table.record_select')
            ->addIndexColumn()
            ->editColumn('created_at', function (Orchard $chard) {
                return $chard->created_at->diffforhumans();
            })
            ->editColumn('supported_side', function (Orchard $chard) {
                return view('dashboard.admin.orchards.data_table.supported_side', compact('chard'));
            })
            ->addColumn('farmer', function (Orchard $chard) {
                return $chard->farmer->firstname;
            })
//            ->addColumn('admin', function (Orchard $chard) {
//                return $chard->admin->firstname;
//            })
            ->addColumn('area', function (Orchard $chard) {
                return $chard->area->name;
            })
            ->addColumn('state', function (Orchard $chard) {
                return $chard->state->name;
            })
            ->addColumn('village', function (Orchard $chard) {
                return $chard->village->name;
            })
            ->addColumn('landCategory', function (Orchard $chard) {
                return $chard->landCategory->category_name;
            })
            ->addColumn('name', function ($orchards) {
                return implode(', ', $orchards->trees->pluck('name')->toArray());
            })
            ->addColumn('actions', 'dashboard.admin.orchards.data_table.actions')
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
        $villages = Village::where('state_id', '=', $stateID)->get();
        $land_categories = LandCategory::all();
        $units = Unit::all();
        $trees = Tree::all();

        return view('dashboard.admin.orchards.create',
            compact('admin', 'area_name', 'areaID', 'stateID', 'adminId',
                'land_categories', 'state_name', 'trees',
                'villages',
                'units'));
    }

    public function getFarmer($village_id)
    {
        $farmers = Farmer::where('village_id',$village_id)->pluck('firstname', 'id');

        return $farmers;
    }

    public function getFarmerInf($farmer_id)
    {

        $data = Farmer::where('id', $farmer_id)->first();
        return response()->json($data);
    }

    public function store($request)
    {

        DB::beginTransaction();
        try {
            $requestData = $request->validated();
            $orchard = OrChard::create([
                'farmer_id' => $requestData['farmer_id'],
                'admin_id' => $requestData['admin_id'],
                'area_id' => $requestData['area_id'],
                'state_id' => $requestData['state_id'],
                'village_id' => $requestData['village_id'],
                'land_category_id' => $requestData['land_category_id'],
                'tree_count_per_orchard' => $requestData['tree_count_per_orchard'],
                'orchard_area' => $requestData['orchard_area'],
                'unit_id' => $requestData['unit_id'],
                'supported_side' => $requestData['supported_side']

            ]);

            $orchard->trees()->attach($request->trees);

            DB::commit();
            toastr()->success(__('Admin/site.added_successfully'));
            return redirect()->route('orchards.index');


        } catch (\Exception $e) {
            DB::rollBack();
            toastr()->error(__('Admin/attributes.add_wrong'));

            return redirect()->back();
        }

    }

    public function edit($id)

    {
        $orchardID = Crypt::decrypt($id);
        $orchard = Orchard::findorfail($orchardID);
        $adminId = Auth::user()->id;
        $admin = Admin::findorfail($adminId);
        $areaID = $admin->area->id;
        $area_name = $admin->area->name;
        $stateID = $admin->state->id;
        $state_name = $admin->state->name;
        $villages = Village::where('state_id', $stateID)->get();
        $land_categories = LandCategory::all();
        $trees = Tree::all();
        $units = Unit::all();

        return view('dashboard.admin.orchards.edit',
            compact('state_name', 'villages', 'land_categories', 'stateID',
                'adminId', 'areaID', 'area_name', 'trees', 'units', 'orchard'));
    }

    public function update($request, $id)
    {
        DB::beginTransaction();
        try {
            $orchardID = Crypt::decrypt($id);
            $requestData = $request->validated();
            $orchard = Orchard::findorfail($orchardID);

            $orchard->admin_id = $requestData['admin_id'];
            $orchard->area_id = $requestData['area_id'];
            $orchard->state_id = $requestData['state_id'];
            $orchard->farmer_id = $requestData['farmer_id'];

            $orchard->village_id = $requestData['village_id'];
            $orchard->land_category_id = $requestData['land_category_id'];
            $orchard->tree_count_per_orchard = $requestData['tree_count_per_orchard'];
            $orchard->orchard_area = $requestData['orchard_area'];
            $orchard->unit_id = $requestData['unit_id'];
            $orchard->supported_side = $requestData['supported_side'];


            $orchard->update($requestData);
            $orchard->trees()->sync($request->trees);

            DB::commit();
            toastr()->success(__('Admin/site.added_successfully'));
            return redirect()->route('orchards.index');


        } catch (\Exception $e) {
            DB::rollBack();
            toastr()->error(__('Admin/attributes.edit_wrong'));

            return redirect()->back();
        }

    }

    public function destroy($id)
    {
        try {
            $orchardID = Crypt::decrypt($id);
            $orchard = Orchard::findorfail($orchardID);
            $orchard->trees()->detach();
            $orchard->delete();
            toastr()->success(__('Admin/site.deleted_successfully'));
            return redirect()->route('orchards.index');
        } catch (\Exception $e) {
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
                foreach ($delete_select_id as $orchard_ids) {

                    $orchard = Orchard::findorfail($orchard_ids);
                    $orchard->trees()->detach();

                    $orchard->delete();
                }
                DB::commit();

                toastr()->error(__('Admin/site.deleted_successfully'));
                return redirect()->route('orchards.index');
            } else {
                toastr()->error(__('Admin/site.no_data_found'));
                return redirect()->route('orchards.index');
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
        $state_id = $admin->state->id;
        $land_categories = LandCategory::all();
        return view('dashboard.admin.orchards.statistics', compact('admin', 'land_categories','state_id'));

    }

    public function statistics($request)
    {
        $validated = $request->validate([

                'area_id' => 'sometimes|nullable|exists:areas,id',
                'state_id' => 'sometimes|nullable|exists:states,id',
                'village_id' => 'sometimes|nullable|exists:villages,id',
                'marketing_side' => 'sometimes|nullable|in:private,govermental,international_organizations',
                'land_category_id' => 'sometimes|nullable|exists:land_categories,id',
            ]
            , [
                'area_id.exists' => trans('Admin/validation.exists'),
                'state_id.exists' => trans('Admin/validation.exists'),
                'village_id.exists' => trans('Admin/validation.exists'),
                'land_category_id.exists' => trans('Admin/validation.exists'),

            ]
        );
        $adminID = Auth::user()->id;
        $admin = Admin::findorfail($adminID);
        $supported_side = $request->supported_side;
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

        if ($admin->type == 'employee') {
            if ($request->village_id != null && $request->land_category_id != null && $request->supported_side != null) {

                $area_id = $admin->area_id;
                $state_id = $admin->state_id;
                $statistics = Orchard::select('area_translations.name AS Area', 'state_translations.name AS State',
                    'village_translations.name AS village_name', 'farmers.firstname AS farmer_name',
                    'orchards.supported_side AS supported_side', 'admins.firstname AS admin_name',
                    'land_category_translations.category_name AS category_name',

                    DB::raw('SUM(orchards.orchard_area) As orchard_area'),
                    DB::raw('SUM(orchards.tree_count_per_orchard) As tree_count_per_orchard')
                )
                    ->join('admins', 'orchards.admin_id', '=', 'admins.id')
                    ->join('village_translations', 'orchards.village_id', '=', 'village_translations.id')
                    ->join('area_translations', 'orchards.area_id', '=', 'area_translations.id')
                    ->join('state_translations', 'orchards.state_id', '=', 'state_translations.id')
                    ->join('farmers', 'orchards.farmer_id', '=', 'farmers.id')
                    ->join('land_category_translations', 'orchards.land_category_id', '=', 'land_category_translations.id')
                    ->where('orchards.admin_id', $admin->id)
                    ->where('area_translations.area_id', $area_id)
                    ->where('state_translations.state_id', $state_id)
                    ->where('village_translations.name', $village_name)
                    ->where('land_category_translations.category_name', $land_category_name)
                    ->where('orchards.supported_side', $supported_side)
                    ->GroupBy('Area', 'State', 'village_name', 'farmer_name', 'supported_side', 'category_name',
                        'admin_name')
                    ->get();
                return view('dashboard.admin.orchards.statistics', compact('admin', 'statistics','state_id'));

            } elseif
            ($request->village_id != null && $request->land_category_id != null && $request->supported_side == null) {
                $area_id = $admin->area_id;
                $state_id = $admin->state_id;
                $statistics = Orchard::select('area_translations.name AS Area', 'state_translations.name AS State',
                    'village_translations.name AS village_name', 'farmers.firstname AS farmer_name',
                    'orchards.supported_side AS supported_side', 'admins.firstname AS admin_name',
                    'land_category_translations.category_name AS category_name',

                    DB::raw('SUM(orchards.orchard_area) As orchard_area'),
                    DB::raw('SUM(orchards.tree_count_per_orchard) As tree_count_per_orchard')
                )
                    ->join('admins', 'orchards.admin_id', '=', 'admins.id')
                    ->join('village_translations', 'orchards.village_id', '=', 'village_translations.id')
                    ->join('area_translations', 'orchards.area_id', '=', 'area_translations.id')
                    ->join('state_translations', 'orchards.state_id', '=', 'state_translations.id')
                    ->join('farmers', 'orchards.farmer_id', '=', 'farmers.id')
                    ->join('land_category_translations', 'orchards.land_category_id', '=', 'land_category_translations.id')
                    ->where('orchards.admin_id', $admin->id)
                    ->where('area_translations.area_id', $area_id)
                    ->where('state_translations.state_id', $state_id)
                    ->where('village_translations.name', $village_name)
                    ->where('land_category_translations.category_name', $land_category_name)
                    ->GroupBy('Area', 'State', 'village_name', 'farmer_name', 'supported_side', 'category_name',
                        'admin_name')
                    ->get();
                return view('dashboard.admin.orchards.statistics', compact('admin', 'statistics','state_id'));

            } elseif
            ($request->village_id != null && $request->land_category_id == null && $request->supported_side != null) {
                $area_id = $admin->area_id;
                $state_id = $admin->state_id;
                $statistics = Orchard::select('area_translations.name AS Area', 'state_translations.name AS State',
                    'village_translations.name AS village_name', 'farmers.firstname AS farmer_name',
                    'orchards.supported_side AS supported_side', 'admins.firstname AS admin_name',
                    'land_category_translations.category_name AS category_name',

                    DB::raw('SUM(orchards.orchard_area) As orchard_area'),
                    DB::raw('SUM(orchards.tree_count_per_orchard) As tree_count_per_orchard')
                )
                    ->join('admins', 'orchards.admin_id', '=', 'admins.id')
                    ->join('village_translations', 'orchards.village_id', '=', 'village_translations.id')
                    ->join('area_translations', 'orchards.area_id', '=', 'area_translations.id')
                    ->join('state_translations', 'orchards.state_id', '=', 'state_translations.id')
                    ->join('farmers', 'orchards.farmer_id', '=', 'farmers.id')
                    ->join('land_category_translations', 'orchards.land_category_id', '=', 'land_category_translations.id')
                    ->where('orchards.admin_id', $admin->id)
                    ->where('area_translations.area_id', $area_id)
                    ->where('state_translations.state_id', $state_id)
                    ->where('village_translations.name', $village_name)
                    ->where('orchards.supported_side', $supported_side)
                    ->GroupBy('Area', 'State', 'village_name', 'farmer_name', 'supported_side', 'category_name',
                        'admin_name')
                    ->get();
                return view('dashboard.admin.orchards.statistics', compact('admin', 'statistics','state_id'));

            } elseif
            ($request->village_id == null && $request->land_category_id == null && $request->supported_side == null) {
                $area_id = $admin->area_id;
                $state_id = $admin->state_id;
                $statistics = Orchard::select('area_translations.name AS Area', 'state_translations.name AS State',
                    'village_translations.name AS village_name', 'farmers.firstname AS farmer_name',
                    'orchards.supported_side AS supported_side', 'admins.firstname AS admin_name',
                    'land_category_translations.category_name AS category_name',

                    DB::raw('SUM(orchards.orchard_area) As orchard_area'),
                    DB::raw('SUM(orchards.tree_count_per_orchard) As tree_count_per_orchard')
                )
                    ->join('admins', 'orchards.admin_id', '=', 'admins.id')
                    ->join('village_translations', 'orchards.village_id', '=', 'village_translations.id')
                    ->join('area_translations', 'orchards.area_id', '=', 'area_translations.id')
                    ->join('state_translations', 'orchards.state_id', '=', 'state_translations.id')
                    ->join('farmers', 'orchards.farmer_id', '=', 'farmers.id')
                    ->join('land_category_translations', 'orchards.land_category_id', '=', 'land_category_translations.id')
                    ->where('orchards.admin_id', $admin->id)
                    ->where('area_translations.area_id', $area_id)
                    ->where('state_translations.state_id', $state_id)
                    ->GroupBy('Area', 'State', 'village_name', 'farmer_name', 'supported_side', 'category_name',
                        'admin_name')
                    ->get();
                return view('dashboard.admin.orchards.statistics', compact('admin', 'statistics','state_id'));

            } elseif ($request->village_id != null && $request->land_category_id == null && $request->supported_side == null) {
                $area_id = $admin->area_id;
                $state_id = $admin->state_id;

                $statistics = Orchard::select('area_translations.name AS Area', 'state_translations.name AS State',
                    'village_translations.name AS village_name', 'farmers.firstname AS farmer_name',
                    'orchards.supported_side AS supported_side', 'admins.firstname AS admin_name',
                    'land_category_translations.category_name AS category_name',

                    DB::raw('SUM(orchards.orchard_area) As orchard_area'),
                    DB::raw('SUM(orchards.tree_count_per_orchard) As tree_count_per_orchard')
                )
                    ->join('admins', 'orchards.admin_id', '=', 'admins.id')
                    ->join('village_translations', 'orchards.village_id', '=', 'village_translations.id')
                    ->join('area_translations', 'orchards.area_id', '=', 'area_translations.id')
                    ->join('state_translations', 'orchards.state_id', '=', 'state_translations.id')
                    ->join('farmers', 'orchards.farmer_id', '=', 'farmers.id')
                    ->join('land_category_translations', 'orchards.land_category_id', '=', 'land_category_translations.id')
                    ->where('orchards.admin_id', $admin->id)
                    ->where('area_translations.area_id', $area_id)
                    ->where('state_translations.state_id', $state_id)
                    ->where('village_translations.name', $village_name)
                    ->GroupBy('Area', 'State', 'village_name', 'farmer_name', 'supported_side', 'category_name',
                        'admin_name')
                    ->get();
                return view('dashboard.admin.orchards.statistics', compact('admin', 'statistics','state_id'));

            }
        }
        else if ($admin->type == 'admin') {
            if ($request->area_id != null && $request->state_id != null && $request->village_id != null
                && $request->land_category_id != null && $request->supported_side != null) {

                $statistics = Orchard::select('area_translations.name AS Area', 'state_translations.name AS State',
                    'village_translations.name AS village_name', 'farmers.firstname AS farmer_name',
                    'orchards.supported_side AS supported_side', 'admins.firstname AS admin_name',
                    'land_category_translations.category_name AS category_name',

                    DB::raw('SUM(orchards.orchard_area) As orchard_area'),
                    DB::raw('SUM(orchards.tree_count_per_orchard) As tree_count_per_orchard')
                )
                    ->join('admins', 'orchards.admin_id', '=', 'admins.id')
                    ->join('village_translations', 'orchards.village_id', '=', 'village_translations.id')
                    ->join('area_translations', 'orchards.area_id', '=', 'area_translations.id')
                    ->join('state_translations', 'orchards.state_id', '=', 'state_translations.id')
                    ->join('farmers', 'orchards.farmer_id', '=', 'farmers.id')
                    ->join('land_category_translations', 'orchards.land_category_id', '=', 'land_category_translations.id')
                    ->where('area_translations.name', $area_name)
                    ->where('state_translations.name', $state_name)
                    ->where('village_translations.name', $village_name)
                    ->where('land_category_translations.category_name', $land_category_name)
                    ->where('orchards.supported_side', $supported_side)
                    ->GroupBy('Area', 'State', 'village_name', 'farmer_name', 'supported_side', 'category_name',
                        'admin_name')
                    ->get();
                return view('dashboard.admin.orchards.statistics', compact('admin', 'statistics'));

            } elseif ($request->area_id != null && $request->state_id == null && $request->village_id == null
                && $request->land_category_id == null && $request->supported_side == null) {


                $statistics = Orchard::select('area_translations.name AS Area', 'state_translations.name AS State',
                    'village_translations.name AS village_name', 'farmers.firstname AS farmer_name',
                    'orchards.supported_side AS supported_side', 'admins.firstname AS admin_name',
                    'land_category_translations.category_name AS category_name',

                    DB::raw('SUM(orchards.orchard_area) As orchard_area'),
                    DB::raw('SUM(orchards.tree_count_per_orchard) As tree_count_per_orchard')
                )
                    ->join('admins', 'orchards.admin_id', '=', 'admins.id')
                    ->join('village_translations', 'orchards.village_id', '=', 'village_translations.id')
                    ->join('area_translations', 'orchards.area_id', '=', 'area_translations.id')
                    ->join('state_translations', 'orchards.state_id', '=', 'state_translations.id')
                    ->join('farmers', 'orchards.farmer_id', '=', 'farmers.id')
                    ->join('land_category_translations', 'orchards.land_category_id', '=', 'land_category_translations.id')
                    ->where('area_translations.name', $area_name)
                    ->GroupBy('Area', 'State', 'village_name', 'farmer_name', 'supported_side', 'category_name',
                        'admin_name')
                    ->get();
                return view('dashboard.admin.orchards.statistics', compact('admin', 'statistics'));


            } elseif ($request->area_id != null && $request->state_id == null && $request->village_id == null
                && $request->land_category_id != null && $request->supported_side != null) {

                $statistics = Orchard::select('area_translations.name AS Area', 'state_translations.name AS State',
                    'village_translations.name AS village_name', 'farmers.firstname AS farmer_name',
                    'orchards.supported_side AS supported_side', 'admins.firstname AS admin_name',
                    'land_category_translations.category_name AS category_name',

                    DB::raw('SUM(orchards.orchard_area) As orchard_area'),
                    DB::raw('SUM(orchards.tree_count_per_orchard) As tree_count_per_orchard')
                )
                    ->join('admins', 'orchards.admin_id', '=', 'admins.id')
                    ->join('village_translations', 'orchards.village_id', '=', 'village_translations.id')
                    ->join('area_translations', 'orchards.area_id', '=', 'area_translations.id')
                    ->join('state_translations', 'orchards.state_id', '=', 'state_translations.id')
                    ->join('farmers', 'orchards.farmer_id', '=', 'farmers.id')
                    ->join('land_category_translations', 'orchards.land_category_id', '=', 'land_category_translations.id')
                    ->where('area_translations.name', $area_name)
                    ->where('land_category_translations.category_name', $land_category_name)
                    ->where('orchards.supported_side', $supported_side)
                    ->GroupBy('Area', 'State', 'village_name', 'farmer_name', 'supported_side', 'category_name',
                        'admin_name')
                    ->get();
                return view('dashboard.admin.orchards.statistics', compact('admin', 'statistics'));


            } elseif ($request->area_id == null && $request->state_id == null && $request->village_id == null
                && $request->land_category_id == null && $request->supported_side == null) {

                $statistics = Orchard::select('area_translations.name AS Area', 'state_translations.name AS State',
                    'village_translations.name AS village_name', 'farmers.firstname AS farmer_name',
                    'orchards.supported_side AS supported_side', 'admins.firstname AS admin_name',
                    'land_category_translations.category_name AS category_name',

                    DB::raw('SUM(orchards.orchard_area) As orchard_area'),
                    DB::raw('SUM(orchards.tree_count_per_orchard) As tree_count_per_orchard')
                )
                    ->join('admins', 'orchards.admin_id', '=', 'admins.id')
                    ->join('village_translations', 'orchards.village_id', '=', 'village_translations.id')
                    ->join('area_translations', 'orchards.area_id', '=', 'area_translations.id')
                    ->join('state_translations', 'orchards.state_id', '=', 'state_translations.id')
                    ->join('farmers', 'orchards.farmer_id', '=', 'farmers.id')
                    ->join('land_category_translations', 'orchards.land_category_id', '=', 'land_category_translations.id')
                    ->GroupBy('Area', 'State', 'village_name', 'farmer_name', 'supported_side', 'category_name',
                        'admin_name')
                    ->get();
                return view('dashboard.admin.orchards.statistics', compact('admin', 'statistics'));


            } elseif ($request->area_id != null && $request->state_id == null && $request->village_id == null
                && $request->land_category_id != null && $request->supported_side == null) {

                $statistics = Orchard::select('area_translations.name AS Area', 'state_translations.name AS State',
                    'village_translations.name AS village_name', 'farmers.firstname AS farmer_name',
                    'orchards.supported_side AS supported_side', 'admins.firstname AS admin_name',
                    'land_category_translations.category_name AS category_name',

                    DB::raw('SUM(orchards.orchard_area) As orchard_area'),
                    DB::raw('SUM(orchards.tree_count_per_orchard) As tree_count_per_orchard')
                )
                    ->join('admins', 'orchards.admin_id', '=', 'admins.id')
                    ->join('village_translations', 'orchards.village_id', '=', 'village_translations.id')
                    ->join('area_translations', 'orchards.area_id', '=', 'area_translations.id')
                    ->join('state_translations', 'orchards.state_id', '=', 'state_translations.id')
                    ->join('farmers', 'orchards.farmer_id', '=', 'farmers.id')
                    ->join('land_category_translations', 'orchards.land_category_id', '=', 'land_category_translations.id')
                    ->where('area_translations.name', $area_name)
                    ->where('land_category_translations.category_name', $land_category_name)
                    ->GroupBy('Area', 'State', 'village_name', 'farmer_name', 'supported_side', 'category_name',
                        'admin_name')
                    ->get();
                return view('dashboard.admin.orchards.statistics', compact('admin', 'statistics'));


            } elseif ($request->area_id != null && $request->state_id == null && $request->village_id == null
                && $request->land_category_id == null && $request->supported_side != null) {

                $statistics = Orchard::select('area_translations.name AS Area', 'state_translations.name AS State',
                    'village_translations.name AS village_name', 'farmers.firstname AS farmer_name',
                    'orchards.supported_side AS supported_side', 'admins.firstname AS admin_name',
                    'land_category_translations.category_name AS category_name',

                    DB::raw('SUM(orchards.orchard_area) As orchard_area'),
                    DB::raw('SUM(orchards.tree_count_per_orchard) As tree_count_per_orchard')
                )
                    ->join('admins', 'orchards.admin_id', '=', 'admins.id')
                    ->join('village_translations', 'orchards.village_id', '=', 'village_translations.id')
                    ->join('area_translations', 'orchards.area_id', '=', 'area_translations.id')
                    ->join('state_translations', 'orchards.state_id', '=', 'state_translations.id')
                    ->join('farmers', 'orchards.farmer_id', '=', 'farmers.id')
                    ->join('land_category_translations', 'orchards.land_category_id', '=', 'land_category_translations.id')
                    ->where('area_translations.name', $area_name)
                    ->where('orchards.supported_side', $supported_side)
                    ->GroupBy('Area', 'State', 'village_name', 'farmer_name', 'supported_side', 'category_name',
                        'admin_name')
                    ->get();
                return view('dashboard.admin.orchards.statistics', compact('admin', 'statistics'));


            } elseif ($request->area_id != null && $request->state_id != null && $request->village_id == null
                && $request->land_category_id == null && $request->supported_side == null) {

                $statistics = Orchard::select('area_translations.name AS Area', 'state_translations.name AS State',
                    'village_translations.name AS village_name', 'farmers.firstname AS farmer_name',
                    'orchards.supported_side AS supported_side', 'admins.firstname AS admin_name',
                    'land_category_translations.category_name AS category_name',

                    DB::raw('SUM(orchards.orchard_area) As orchard_area'),
                    DB::raw('SUM(orchards.tree_count_per_orchard) As tree_count_per_orchard')
                )
                    ->join('admins', 'orchards.admin_id', '=', 'admins.id')
                    ->join('village_translations', 'orchards.village_id', '=', 'village_translations.id')
                    ->join('area_translations', 'orchards.area_id', '=', 'area_translations.id')
                    ->join('state_translations', 'orchards.state_id', '=', 'state_translations.id')
                    ->join('farmers', 'orchards.farmer_id', '=', 'farmers.id')
                    ->join('land_category_translations', 'orchards.land_category_id', '=', 'land_category_translations.id')
                    ->where('area_translations.name', $area_name)
                    ->where('state_translations.name', $state_name)
                    ->GroupBy('Area', 'State', 'village_name', 'farmer_name', 'supported_side', 'category_name',
                        'admin_name')
                    ->get();
                return view('dashboard.admin.orchards.statistics', compact('admin', 'statistics'));

            } elseif ($request->area_id != null && $request->state_id != null && $request->village_id == null
                && $request->land_category_id != null && $request->supported_side != null) {
                $statistics = Orchard::select('area_translations.name AS Area', 'state_translations.name AS State',
                    'village_translations.name AS village_name', 'farmers.firstname AS farmer_name',
                    'orchards.supported_side AS supported_side', 'admins.firstname AS admin_name',
                    'land_category_translations.category_name AS category_name',

                    DB::raw('SUM(orchards.orchard_area) As orchard_area'),
                    DB::raw('SUM(orchards.tree_count_per_orchard) As tree_count_per_orchard')
                )
                    ->join('admins', 'orchards.admin_id', '=', 'admins.id')
                    ->join('village_translations', 'orchards.village_id', '=', 'village_translations.id')
                    ->join('area_translations', 'orchards.area_id', '=', 'area_translations.id')
                    ->join('state_translations', 'orchards.state_id', '=', 'state_translations.id')
                    ->join('farmers', 'orchards.farmer_id', '=', 'farmers.id')
                    ->join('land_category_translations', 'orchards.land_category_id', '=', 'land_category_translations.id')
                    ->where('area_translations.name', $area_name)
                    ->where('state_translations.name', $state_name)
                    ->where('land_category_translations.category_name', $land_category_name)
                    ->where('orchards.supported_side', $supported_side)
                    ->GroupBy('Area', 'State', 'village_name', 'farmer_name', 'supported_side', 'category_name',
                        'admin_name')
                    ->get();
                return view('dashboard.admin.orchards.statistics', compact('admin', 'statistics'));

            } elseif
            ($request->area_id != null && $request->state_id != null && $request->village_id == null
                && $request->land_category_id != null && $request->supported_side == null) {

                $statistics = Orchard::select('area_translations.name AS Area', 'state_translations.name AS State',
                    'village_translations.name AS village_name', 'farmers.firstname AS farmer_name',
                    'orchards.supported_side AS supported_side', 'admins.firstname AS admin_name',
                    'land_category_translations.category_name AS category_name',

                    DB::raw('SUM(orchards.orchard_area) As orchard_area'),
                    DB::raw('SUM(orchards.tree_count_per_orchard) As tree_count_per_orchard')
                )
                    ->join('admins', 'orchards.admin_id', '=', 'admins.id')
                    ->join('village_translations', 'orchards.village_id', '=', 'village_translations.id')
                    ->join('area_translations', 'orchards.area_id', '=', 'area_translations.id')
                    ->join('state_translations', 'orchards.state_id', '=', 'state_translations.id')
                    ->join('farmers', 'orchards.farmer_id', '=', 'farmers.id')
                    ->join('land_category_translations', 'orchards.land_category_id', '=', 'land_category_translations.id')
                    ->where('area_translations.name', $area_name)
                    ->where('state_translations.name', $state_name)
                    ->where('land_category_translations.category_name', $land_category_name)
                    ->GroupBy('Area', 'State', 'village_name', 'farmer_name', 'supported_side', 'category_name',
                        'admin_name')
                    ->get();
                return view('dashboard.admin.orchards.statistics', compact('admin', 'statistics'));

            } elseif ($request->area_id != null && $request->state_id != null && $request->village_id == null
                && $request->land_category_id == null && $request->supported_side != null) {

                $statistics = Orchard::select('area_translations.name AS Area', 'state_translations.name AS State',
                    'village_translations.name AS village_name', 'farmers.firstname AS farmer_name',
                    'orchards.supported_side AS supported_side', 'admins.firstname AS admin_name',
                    'land_category_translations.category_name AS category_name',

                    DB::raw('SUM(orchards.orchard_area) As orchard_area'),
                    DB::raw('SUM(orchards.tree_count_per_orchard) As tree_count_per_orchard')
                )
                    ->join('admins', 'orchards.admin_id', '=', 'admins.id')
                    ->join('village_translations', 'orchards.village_id', '=', 'village_translations.id')
                    ->join('area_translations', 'orchards.area_id', '=', 'area_translations.id')
                    ->join('state_translations', 'orchards.state_id', '=', 'state_translations.id')
                    ->join('farmers', 'orchards.farmer_id', '=', 'farmers.id')
                    ->join('land_category_translations', 'orchards.land_category_id', '=', 'land_category_translations.id')
                    ->where('area_translations.name', $area_name)
                    ->where('state_translations.name', $state_name)
                    ->where('orchards.supported_side', $supported_side)
                    ->GroupBy('Area', 'State', 'village_name', 'farmer_name', 'supported_side', 'category_name',
                        'admin_name')
                    ->get();
                return view('dashboard.admin.orchards.statistics', compact('admin', 'statistics'));

            } elseif ($request->area_id != null && $request->state_id != null && $request->village_id != null
                && $request->land_category_id == null && $request->supported_side == null) {

                $statistics = Orchard::select('area_translations.name AS Area', 'state_translations.name AS State',
                    'village_translations.name AS village_name', 'farmers.firstname AS farmer_name',
                    'orchards.supported_side AS supported_side', 'admins.firstname AS admin_name',
                    'land_category_translations.category_name AS category_name',

                    DB::raw('SUM(orchards.orchard_area) As orchard_area'),
                    DB::raw('SUM(orchards.tree_count_per_orchard) As tree_count_per_orchard')
                )
                    ->join('admins', 'orchards.admin_id', '=', 'admins.id')
                    ->join('village_translations', 'orchards.village_id', '=', 'village_translations.id')
                    ->join('area_translations', 'orchards.area_id', '=', 'area_translations.id')
                    ->join('state_translations', 'orchards.state_id', '=', 'state_translations.id')
                    ->join('farmers', 'orchards.farmer_id', '=', 'farmers.id')
                    ->join('land_category_translations', 'orchards.land_category_id', '=', 'land_category_translations.id')
                    ->where('area_translations.name', $area_name)
                    ->where('state_translations.name', $state_name)
                    ->where('village_translations.name', $village_name)
                    ->GroupBy('Area', 'State', 'village_name', 'farmer_name', 'supported_side', 'category_name',
                        'admin_name')
                    ->get();
                return view('dashboard.admin.orchards.statistics', compact('admin', 'statistics'));

            } elseif ($request->area_id != null && $request->state_id != null && $request->village_id != null
                && $request->land_category_id != null && $request->supported_side == null) {


                $statistics = Orchard::select('area_translations.name AS Area', 'state_translations.name AS State',
                    'village_translations.name AS village_name', 'farmers.firstname AS farmer_name',
                    'orchards.supported_side AS supported_side', 'admins.firstname AS admin_name',
                    'land_category_translations.category_name AS category_name',

                    DB::raw('SUM(orchards.orchard_area) As orchard_area'),
                    DB::raw('SUM(orchards.tree_count_per_orchard) As tree_count_per_orchard')
                )
                    ->join('admins', 'orchards.admin_id', '=', 'admins.id')
                    ->join('village_translations', 'orchards.village_id', '=', 'village_translations.id')
                    ->join('area_translations', 'orchards.area_id', '=', 'area_translations.id')
                    ->join('state_translations', 'orchards.state_id', '=', 'state_translations.id')
                    ->join('farmers', 'orchards.farmer_id', '=', 'farmers.id')
                    ->join('land_category_translations', 'orchards.land_category_id', '=', 'land_category_translations.id')
                    ->where('area_translations.name', $area_name)
                    ->where('state_translations.name', $state_name)
                    ->where('village_translations.name', $village_name)
                    ->where('land_category_translations.category_name', $land_category_name)
                    ->GroupBy('Area', 'State', 'village_name', 'farmer_name', 'supported_side', 'category_name',
                        'admin_name')
                    ->get();
                return view('dashboard.admin.orchards.statistics', compact('admin', 'statistics'));

            } elseif ($request->area_id != null && $request->state_id != null && $request->village_id != null
                && $request->land_category_id == null && $request->supported_side != null) {
                $statistics = Orchard::select('area_translations.name AS Area', 'state_translations.name AS State',
                    'village_translations.name AS village_name', 'farmers.firstname AS farmer_name',
                    'orchards.supported_side AS supported_side', 'admins.firstname AS admin_name',
                    'land_category_translations.category_name AS category_name',

                    DB::raw('SUM(orchards.orchard_area) As orchard_area'),
                    DB::raw('SUM(orchards.tree_count_per_orchard) As tree_count_per_orchard')
                )
                    ->join('admins', 'orchards.admin_id', '=', 'admins.id')
                    ->join('village_translations', 'orchards.village_id', '=', 'village_translations.id')
                    ->join('area_translations', 'orchards.area_id', '=', 'area_translations.id')
                    ->join('state_translations', 'orchards.state_id', '=', 'state_translations.id')
                    ->join('farmers', 'orchards.farmer_id', '=', 'farmers.id')
                    ->join('land_category_translations', 'orchards.land_category_id', '=', 'land_category_translations.id')
                    ->where('area_translations.name', $area_name)
                    ->where('state_translations.name', $state_name)
                    ->where('village_translations.name', $village_name)
                    ->where('orchards.supported_side', $supported_side)
                    ->GroupBy('Area', 'State', 'village_name', 'farmer_name', 'supported_side', 'category_name',
                        'admin_name')
                    ->get();
                return view('dashboard.admin.orchards.statistics', compact('admin', 'statistics'));

            } elseif (!empty('area_id') && !empty('state_id') && !empty('village_id') && !empty('land_category_id') && !empty($request->supported_side)) {

                $statistics = Orchard::select('area_translations.name AS Area', 'state_translations.name AS State',
                    'village_translations.name AS village_name', 'farmers.firstname AS farmer_name',
                    'orchards.supported_side AS supported_side', 'admins.firstname AS admin_name',
                    'land_category_translations.category_name AS category_name',

                    DB::raw('SUM(orchards.orchard_area) As orchard_area'),
                    DB::raw('SUM(orchards.tree_count_per_orchard) As tree_count_per_orchard')
                )
                    ->join('admins', 'orchards.admin_id', '=', 'admins.id')
                    ->join('village_translations', 'orchards.village_id', '=', 'village_translations.id')
                    ->join('area_translations', 'orchards.area_id', '=', 'area_translations.id')
                    ->join('state_translations', 'orchards.state_id', '=', 'state_translations.id')
                    ->join('farmers', 'orchards.farmer_id', '=', 'farmers.id')
                    ->join('land_category_translations', 'orchards.land_category_id', '=', 'land_category_translations.id')
                    ->where('area_translations.name', $area_name)
                    ->where('state_translations.name', $state_name)
                    ->where('village_translations.name', $village_name)
                    ->where('land_category_translations.category_name', $land_category_name)
                    ->where('orchards.supported_side', $supported_side)
                    ->GroupBy('Area', 'State', 'village_name', 'farmer_name', 'supported_side', 'category_name',
                        'admin_name')
                    ->get();
                return view('dashboard.admin.orchards.statistics', compact('admin', 'statistics'));

            }
        }


    }


}