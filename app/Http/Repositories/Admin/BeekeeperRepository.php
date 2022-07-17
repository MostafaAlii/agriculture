<?php

namespace App\Http\Repositories\Admin;

use App\Models\BeeKeeper;
use App\Models\Admin;
use App\Models\AreaTranslation;
use App\Models\StateTranslation;
use App\Models\VillageTranslation;
use App\Models\CourseBee;
use App\Models\BeeDisaster;
use App\Models\Unit;

use App\Models\Village;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use App\Traits\UploadT;
use Auth;
use Yajra\DataTables\DataTables;
use App\Http\Interfaces\Admin\BeekeeperInterface;

class BeekeeperRepository implements BeekeeperInterface
{
    public function index()
    {
        $adminID = Auth::user()->id;
        $admin = Admin::findorfail($adminID);

        if ($admin->area == Null && $admin->state == null) {
            toastr()->error(__('Admin/bees.index-wrong'));

            return redirect()->back();
        } else {
            $area_name = $admin->area->name;
            $state_name = $admin->state->name;
            return view('dashboard.admin.beekeepers.index',
                compact('admin', 'area_name', 'state_name'));
        }


    }


    public function data()
    {
        $adminID = Auth::user()->id;
        $admin = Admin::findorfail($adminID);
        if ($admin->type == 'employee') {
            $beekeepers = BeeKeeper::with('admin', 'farmer', 'village', 'coursebees', 'beedisasters', 'area', 'state')
                ->where('admin_id', $admin->id)
                ->selectRaw('distinct bee_keepers.*')->get();
        } else {
            $beekeepers = BeeKeeper::with('admin', 'farmer', 'village', 'coursebees', 'beedisasters')
                ->selectRaw('distinct bee_keepers.*')->get();
        }
        return DataTables::of($beekeepers)
            ->addColumn('record_select', 'dashboard.admin.beekeepers.data_table.record_select')
            ->addIndexColumn()
            ->editColumn('created_at', function (BeeKeeper $beekeeper) {
                return $beekeeper->created_at->diffforhumans();
            })
            ->editColumn('supported_side', function (BeeKeeper $beekeeper) {
                return view('dashboard.admin.beekeepers.data_table.supported_side', compact('beekeeper'));
            })
            ->editColumn('supported_side', function (BeeKeeper $beekeeper) {
                return view('dashboard.admin.beekeepers.data_table.supported_side', compact('beekeeper'));
            })
            ->addColumn('farmer', function (BeeKeeper $beekeeper) {
                return $beekeeper->farmer->firstname;
            })
//            ->addColumn('admin', function (BeeKeeper $beekeeper) {
//                return $beekeeper->admin->firstname;
//            })
            ->addColumn('area', function (BeeKeeper $beekeeper) {
                return $beekeeper->area->name;

            })
            ->addColumn('state', function (BeeKeeper $beekeeper) {
                return $beekeeper->state->name;

            })
            ->addColumn('village', function (BeeKeeper $beekeeper) {
                return $beekeeper->village->name;

            })
            ->addColumn('c_name', function ($beekeeper) {
                return implode(', ', $beekeeper->coursebees->pluck('name')->toArray());
            })->rawColumns(['c_name'])
            ->addColumn('d_name', function ($beekeeper) {
                return implode(', ', $beekeeper->beedisasters->pluck('name')->toArray());
            })->rawColumns(['d_name'])
            ->addColumn('actions', 'dashboard.admin.beekeepers.data_table.actions')
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
        $courses = CourseBee::all();
        $disasters = BeeDisaster::all();
        $units = Unit::all();

        return view('dashboard.admin.beekeepers.create',
            compact('admin', 'villages', 'area_name', 'areaID', 'stateID', 'state_name', 'adminId',
                'disasters', 'courses', 'units'));
    }


    public function store($request)

    {
        DB::beginTransaction();
        try {

            $requestData = $request->validated();

            $beekeeper = BeeKeeper::create([
                'admin_id' => $requestData['admin_id'],
                'farmer_id' => $requestData['farmer_id'],
                'state_id' => $requestData['state_id'],
                'area_id' => $requestData['area_id'],
                'village_id' => $requestData['village_id'],
                'died_beehive_count' => $requestData['died_beehive_count'],
                'annual_new_product_beehive' => $requestData['annual_new_product_beehive'],
                'annual_old_product_beehive' => $requestData['annual_old_product_beehive'],
                'new_beehive_count' => $requestData['new_beehive_count'],
                'old_beehive_count' => $requestData['old_beehive_count'],
                'unit_id' => $requestData['unit_id'],
                'supported_side' => $requestData['supported_side'],
                'cost' => $requestData['cost'],


            ]);
            $beekeeper->beedisasters()->attach($request->disasters);
            $beekeeper->coursebees()->attach($request->courses);


            DB::commit();
            toastr()->success(__('Admin/site.added_successfully'));
            return redirect()->route('BeeKeepers.index');


        } catch (\Exception $e) {
            DB::rollBack();
            toastr()->error(__('Admin/attributes.add_wrong'));

            return redirect()->back();
        }

    }


    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $beekeeperID = Crypt::decrypt($id);
        $beekeeper = BeeKeeper::findorfail($beekeeperID);
        $adminId = Auth::user()->id;
        $admin = Admin::findorfail($adminId);
        $areaID = $admin->area->id;
        $area_name = $admin->area->name;
        $stateID = $admin->state->id;
        $state_name = $admin->state->name;

        $villages = Village::where('state_id', $stateID)->get();
        $courses = CourseBee::all();
        $disasters = BeeDisaster::all();
        $units = Unit::all();
        return view('dashboard.admin.beekeepers.edit',
            compact('villages', 'admin', 'areaID', 'area_name', 'state_name', 'stateID', 'adminId',
                'disasters', 'courses', 'units', 'beekeeper'));
    }

    public function update($request, $id)
    {
        DB::beginTransaction();
        try {
            $beekeeperID = Crypt::decrypt($id);

            $requestData = $request->validated();
            $beekeeper = BeeKeeper::findorfail($beekeeperID);
            $beekeeper->admin_id = $requestData['admin_id'];
            $beekeeper->farmer_id = $requestData['farmer_id'];
            $beekeeper->state_id = $requestData['state_id'];
            $beekeeper->area_id = $requestData['area_id'];
            $beekeeper->village_id = $requestData['village_id'];
            $beekeeper->died_beehive_count = $requestData['died_beehive_count'];
            $beekeeper->annual_new_product_beehive = $requestData['annual_new_product_beehive'];
            $beekeeper->annual_old_product_beehive = $requestData['annual_old_product_beehive'];
            $beekeeper->new_beehive_count = $requestData['new_beehive_count'];
            $beekeeper->old_beehive_count = $requestData['old_beehive_count'];
            $beekeeper->unit_id = $requestData['unit_id'];
            $beekeeper->supported_side = $requestData['supported_side'];
            $beekeeper->cost = $requestData['cost'];


            $beekeeper->update($requestData);
            $beekeeper->beedisasters()->sync($request->disasters);
            $beekeeper->coursebees()->sync($request->courses);


            DB::commit();
            toastr()->success(__('Admin/site.added_successfully'));
            return redirect()->route('BeeKeepers.index');


        } catch (\Exception $e) {
            DB::rollBack();
            toastr()->error(__('Admin/attributes.edit_wrong'));

            return redirect()->back();
        }
    }


    public function destroy($id)
    {
        try {
            $beekeeperlID = Crypt::decrypt($id);
            $beekeeper = BeeKeeper::findorfail($beekeeperlID);
            $beekeeper->coursebees()->detach();

            $beekeeper->beedisasters()->detach();
            $beekeeper->delete();
            toastr()->error(__('Admin/site.deleted_successfully'));
            return redirect()->route('BeeKeepers.index');
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
                foreach ($delete_select_id as $beekeeper_ids) {

                    $beekeeper = BeeKeeper::findorfail($beekeeper_ids);
                    $beekeeper->coursebees()->detach();

                    $beekeeper->beedisasters()->detach();

                    $beekeeper->delete();
                }
                DB::commit();

                toastr()->error(__('Admin/site.deleted_successfully'));
                return redirect()->route('BeeKeepers.index');
            } else {
                toastr()->error(__('Admin/site.no_data_found'));
                return redirect()->route('BeeKeepers.index');
            }
        } catch (\Exception $e) {
            DB::rollBack();
            toastr()->error(__('Admin/attributes.delete_wrong'));

            return redirect()->back();

        }


    }// end of bulkDelete

    public function beekeeper_index_statistics()
    {
        $adminID = Auth::user()->id;
        $admin = Admin::findorfail($adminID);
        $state_id = $admin->state->id;
        return view('dashboard.admin.beekeepers.beekeepers_statistics', compact('admin', 'state_id'));


    }

    public function beekeeper_statistics($request)
    {
        $validated = $request->validate([
                'area_id' => 'sometimes|nullable|exists:areas,id',
                'state_id' => 'sometimes|nullable|exists:states,id',

                'village_id' => 'sometimes|nullable|exists:villages,id',
                'supported_side' => 'sometimes|nullable|in:govermental,private,international organizations',
            ]
            , [
                'area_id.exists' => trans('Admin/validation.exists'),
                'state_id.exists' => trans('Admin/validation.exists'),
                'village_id.exists' => trans('Admin/validation.exists'),
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

        if ($admin->type == 'employee') {
            $area_id = $admin->area_id;
            $state_id = $admin->state_id;

            if ($request->village_id != null && $request->supported_side != null) {


                $statistics = BeeKeeper::select('area_translations.name AS Area',
                    'state_translations.name AS State', 'village_translations.name AS village',
                    'bee_keepers.supported_side as supported_side', 'farmers.firstname As farmer_name',
                    DB::raw("COUNT(bee_keepers.village_id) As village_count"),
                    DB::raw('SUM(bee_keepers.old_beehive_count) As old_beehive_count'),
                    DB::raw('SUM(bee_keepers.new_beehive_count) As new_beehive_count'),
                    DB::raw('COUNT(bee_keepers.id) As beehive_count'),
                    DB::raw('COUNT(DISTINCT (bee_keepers.farmer_id)) As farmer_count'),
                    DB::raw('SUM(bee_keepers.annual_new_product_beehive + bee_keepers.annual_old_product_beehive) As total_product'))
                    ->join('area_translations', 'bee_keepers.area_id', '=', 'area_translations.id')
                    ->join('state_translations', 'bee_keepers.state_id', '=', 'state_translations.id')
                    ->join('village_translations', 'bee_keepers.village_id', '=', 'village_translations.id')
                    ->join('farmers', 'bee_keepers.farmer_id', '=', 'farmers.id')

                    ->where('bee_keepers.admin_id', $admin->id)
                    ->where('area_translations.area_id', $area_id)
                    ->where('state_translations.state_id', $state_id)
                    ->where('village_translations.name', $village_name)
                    ->where('bee_keepers.supported_side', $supported_side)
                    ->GroupBy('Area', 'State', 'village', 'supported_side','farmer_name'
                    )->get();
                return view('dashboard.admin.beekeepers.beekeepers_statistics', compact('state_id', 'admin', 'statistics'));

            } elseif ($request->village_id != null && $request->supported_side == null) {


                $statistics = BeeKeeper::select('area_translations.name AS Area',
                    'state_translations.name AS State', 'village_translations.name AS village',
                    'bee_keepers.supported_side as supported_side',
                    DB::raw("COUNT(bee_keepers.village_id) As village_count"),
                    DB::raw('SUM(bee_keepers.old_beehive_count) As new_beehive_count'),
                    DB::raw('SUM(bee_keepers.new_beehive_count) As new_beehive_count'),
                    DB::raw('COUNT(bee_keepers.id) As beehive_count'),
                    DB::raw('COUNT(DISTINCT (bee_keepers.farmer_id)) As farmer_count'),
                    DB::raw('SUM(bee_keepers.annual_new_product_beehive + bee_keepers.annual_old_product_beehive) As total_product'))
                    ->join('area_translations', 'bee_keepers.area_id', '=', 'area_translations.id')
                    ->join('state_translations', 'bee_keepers.state_id', '=', 'state_translations.id')
                    ->join('village_translations', 'bee_keepers.village_id', '=', 'village_translations.id')
                    ->where('bee_keepers.admin_id', $admin->id)
                    ->where('area_translations.area_id', $area_id)
                    ->where('state_translations.state_id', $state_id)
                    ->where('village_translations.name', $village_name)
                    ->GroupBy('Area', 'State', 'village', 'supported_side'
                    )->get();
                return view('dashboard.admin.beekeepers.beekeepers_statistics', compact('state_id', 'admin', 'statistics'));

            } elseif ($request->village_id == null && $request->supported_side != null) {


                $statistics = BeeKeeper::select('area_translations.name AS Area',
                    'state_translations.name AS State', 'village_translations.name AS village',
                    'bee_keepers.supported_side as supported_side', 'farmers.firstname As farmer_name',
                    DB::raw("COUNT(bee_keepers.village_id) As village_count"),
                    DB::raw('SUM(bee_keepers.old_beehive_count) As old_beehive_count'),
                    DB::raw('SUM(bee_keepers.new_beehive_count) As new_beehive_count'),
                    DB::raw('COUNT(bee_keepers.id) As beehive_count'),
                    DB::raw('COUNT(DISTINCT (bee_keepers.farmer_id)) As farmer_count'),
                    DB::raw('SUM(bee_keepers.annual_new_product_beehive + bee_keepers.annual_old_product_beehive) As total_product'))
                    ->join('area_translations', 'bee_keepers.area_id', '=', 'area_translations.id')
                    ->join('farmers', 'bee_keepers.farmer_id', '=', 'farmers.id')

                    ->join('state_translations', 'bee_keepers.state_id', '=', 'state_translations.id')
                    ->join('village_translations', 'bee_keepers.village_id', '=', 'village_translations.id')
                    ->where('bee_keepers.admin_id', $admin->id)
                    ->where('area_translations.area_id', $area_id)
                    ->where('state_translations.state_id', $state_id)
                    ->where('bee_keepers.supported_side', $supported_side)
                    ->GroupBy('Area', 'State', 'village', 'supported_side','farmer_name'
                    )->get();
                return view('dashboard.admin.beekeepers.beekeepers_statistics', compact('state_id', 'admin', 'statistics'));

            } elseif ($request->village_id == null && $request->supported_side == null) {

                $statistics = BeeKeeper::select('area_translations.name AS Area',
                    'state_translations.name AS State', 'village_translations.name AS village',
                    'bee_keepers.supported_side as supported_side', 'farmers.firstname As farmer_name',
                    DB::raw("COUNT(bee_keepers.village_id) As village_count"),
                    DB::raw('SUM(bee_keepers.old_beehive_count) As old_beehive_count'),
                    DB::raw('SUM(bee_keepers.new_beehive_count) As new_beehive_count'),
                    DB::raw('COUNT(bee_keepers.id) As beehive_count'),
                    DB::raw('COUNT(DISTINCT (bee_keepers.farmer_id)) As farmer_count'),
                    DB::raw('SUM(bee_keepers.annual_new_product_beehive + bee_keepers.annual_old_product_beehive) As total_product'))
                    ->join('area_translations', 'bee_keepers.area_id', '=', 'area_translations.id')
                    ->join('state_translations', 'bee_keepers.state_id', '=', 'state_translations.id')
                    ->join('farmers', 'bee_keepers.farmer_id', '=', 'farmers.id')
                    ->join('village_translations', 'bee_keepers.village_id', '=', 'village_translations.id')
                    ->where('bee_keepers.admin_id', $admin->id)
                    ->where('area_translations.area_id', $area_id)
                    ->where('state_translations.state_id', $state_id)
                    ->GroupBy('Area', 'State', 'village', 'supported_side','farmer_name'
                    )->get();
                return view('dashboard.admin.beekeepers.beekeepers_statistics', compact('state_id', 'admin', 'statistics'));

            }
        } elseif ($admin->type == 'admin') {
            if ($request->area_id != null && $request->state_id != null && $request->village_id != null
                && $request->supported_side != null) {
                $statistics = BeeKeeper::select('area_translations.name AS Area',
                    'state_translations.name AS State', 'village_translations.name AS village',
                    'bee_keepers.supported_side as supported_side', 'farmers.firstname As farmer_name',
                    DB::raw("COUNT(bee_keepers.village_id) As village_count"),
                    DB::raw('SUM(bee_keepers.old_beehive_count) As old_beehive_count'),
                    DB::raw('SUM(bee_keepers.new_beehive_count) As new_beehive_count'),
                    DB::raw('COUNT(bee_keepers.id) As beehive_count'),
                    DB::raw('COUNT(DISTINCT (bee_keepers.farmer_id)) As farmer_count'),
                    DB::raw('SUM(bee_keepers.annual_new_product_beehive + bee_keepers.annual_old_product_beehive) As total_product'))
                    ->join('area_translations', 'bee_keepers.area_id', '=', 'area_translations.id')
                    ->join('state_translations', 'bee_keepers.state_id', '=', 'state_translations.id')
                    ->join('farmers', 'bee_keepers.farmer_id', '=', 'farmers.id')
                    ->join('village_translations', 'bee_keepers.village_id', '=', 'village_translations.id')
                    ->where('area_translations.name', $area_name)
                    ->where('state_translations.name', $state_name)
                    ->where('village_translations.name', $village_name)
                    ->where('bee_keepers.supported_side', $supported_side)
                    ->GroupBy('Area', 'State', 'village', 'supported_side', 'farmer_name'
                    )->get();
                return view('dashboard.admin.beekeepers.beekeepers_statistics', compact('admin', 'statistics'));

            } elseif ($request->area_id != null && $request->state_id != null && $request->village_id != null
                && $request->supported_side == null) {
                $statistics = BeeKeeper::select('area_translations.name AS Area',
                    'state_translations.name AS State', 'village_translations.name AS village',
                    'bee_keepers.supported_side as supported_side', 'farmers.firstname As farmer_name',
                    DB::raw("COUNT(bee_keepers.village_id) As village_count"),
                    DB::raw('SUM(bee_keepers.old_beehive_count) As old_beehive_count'),
                    DB::raw('SUM(bee_keepers.new_beehive_count) As new_beehive_count'),
                    DB::raw('COUNT(bee_keepers.id) As beehive_count'),
                    DB::raw('COUNT(DISTINCT (bee_keepers.farmer_id)) As farmer_count'),
                    DB::raw('SUM(bee_keepers.annual_new_product_beehive + bee_keepers.annual_old_product_beehive) As total_product'))
                    ->join('area_translations', 'bee_keepers.area_id', '=', 'area_translations.id')
                    ->join('farmers', 'bee_keepers.farmer_id', '=', 'farmers.id')
                    ->join('state_translations', 'bee_keepers.state_id', '=', 'state_translations.id')
                    ->join('village_translations', 'bee_keepers.village_id', '=', 'village_translations.id')
                    ->where('area_translations.name', $area_name)
                    ->where('state_translations.name', $state_name)
                    ->where('village_translations.name', $village_name)
                    ->GroupBy('Area', 'State', 'village', 'supported_side', 'farmer_name'
                    )->get();
                return view('dashboard.admin.beekeepers.beekeepers_statistics', compact('admin', 'statistics'));

            } elseif ($request->area_id == null && $request->state_id == null && $request->village_id == null
                && $request->supported_side == null) {
                $statistics = BeeKeeper::select('area_translations.name AS Area',
                    'state_translations.name AS State', 'village_translations.name AS village',
                    'bee_keepers.supported_side as supported_side', 'farmers.firstname As farmer_name',
                    DB::raw("COUNT(bee_keepers.village_id) As village_count"),
                    DB::raw('SUM(bee_keepers.old_beehive_count) As old_beehive_count'),
                    DB::raw('SUM(bee_keepers.new_beehive_count) As new_beehive_count'),
                    DB::raw('COUNT(bee_keepers.id) As beehive_count'),
                    DB::raw('COUNT(DISTINCT (bee_keepers.farmer_id)) As farmer_count'),
                    DB::raw('SUM(bee_keepers.annual_new_product_beehive + bee_keepers.annual_old_product_beehive) As total_product'))
                    ->join('area_translations', 'bee_keepers.area_id', '=', 'area_translations.id')
                    ->join('state_translations', 'bee_keepers.state_id', '=', 'state_translations.id')
                    ->join('farmers', 'bee_keepers.farmer_id', '=', 'farmers.id')
                    ->join('village_translations', 'bee_keepers.village_id', '=', 'village_translations.id')
                    ->GroupBy('Area', 'State', 'village', 'supported_side', 'farmer_name'
                    )->get();
                return view('dashboard.admin.beekeepers.beekeepers_statistics', compact('admin', 'statistics'));

            } elseif ($request->area_id != null && $request->state_id == null && $request->village_id == null
                && $request->supported_side != null) {
                $statistics = BeeKeeper::select('area_translations.name AS Area',
                    'state_translations.name AS State', 'village_translations.name AS village',
                    'bee_keepers.supported_side as supported_side', 'farmers.firstname As farmer_name',
                    DB::raw("COUNT(bee_keepers.village_id) As village_count"),
                    DB::raw('SUM(bee_keepers.old_beehive_count) As old_beehive_count'),
                    DB::raw('SUM(bee_keepers.new_beehive_count) As new_beehive_count'),
                    DB::raw('COUNT(bee_keepers.id) As beehive_count'),
                    DB::raw('COUNT(DISTINCT (bee_keepers.farmer_id)) As farmer_count'),
                    DB::raw('SUM(bee_keepers.annual_new_product_beehive + bee_keepers.annual_old_product_beehive) As total_product'))
                    ->join('area_translations', 'bee_keepers.area_id', '=', 'area_translations.id')
                    ->join('farmers', 'bee_keepers.farmer_id', '=', 'farmers.id')
                    ->join('state_translations', 'bee_keepers.state_id', '=', 'state_translations.id')
                    ->join('village_translations', 'bee_keepers.village_id', '=', 'village_translations.id')
                    ->where('area_translations.name', $area_name)
                    ->where('bee_keepers.supported_side', $supported_side)
                    ->GroupBy('Area', 'State', 'village', 'supported_side', 'farmer_name'
                    )->get();
                return view('dashboard.admin.beekeepers.beekeepers_statistics', compact('admin', 'statistics'));

            } elseif ($request->area_id != null && $request->state_id == null && $request->village_id == null
                && $request->supported_side == null) {
                $statistics = BeeKeeper::select('area_translations.name AS Area', 'farmers.firstname As farmer_name',
                    'state_translations.name AS State', 'village_translations.name AS village',
                    'bee_keepers.supported_side as supported_side',
                    DB::raw("COUNT(bee_keepers.village_id) As village_count"),
                    DB::raw('SUM(bee_keepers.old_beehive_count) As old_beehive_count'),
                    DB::raw('SUM(bee_keepers.new_beehive_count) As new_beehive_count'),
                    DB::raw('COUNT(bee_keepers.id) As beehive_count'),
                    DB::raw('COUNT(DISTINCT (bee_keepers.farmer_id)) As farmer_count'),
                    DB::raw('SUM(bee_keepers.annual_new_product_beehive + bee_keepers.annual_old_product_beehive) As total_product'))
                    ->join('area_translations', 'bee_keepers.area_id', '=', 'area_translations.id')
                    ->join('farmers', 'bee_keepers.farmer_id', '=', 'farmers.id')
                    ->join('state_translations', 'bee_keepers.state_id', '=', 'state_translations.id')
                    ->join('village_translations', 'bee_keepers.village_id', '=', 'village_translations.id')
                    ->where('area_translations.name', $area_name)
                    ->GroupBy('Area', 'State', 'village', 'supported_side', 'farmer_name'
                    )->get();
                return view('dashboard.admin.beekeepers.beekeepers_statistics', compact('admin', 'statistics'));

            } elseif ($request->area_id != null && $request->state_id != null && $request->village_id == null
                && $request->supported_side != null) {
                $statistics = BeeKeeper::select('area_translations.name AS Area',
                    'state_translations.name AS State', 'village_translations.name AS village',
                    'bee_keepers.supported_side as supported_side', 'farmers.firstname As farmer_name',
                    DB::raw("COUNT(bee_keepers.village_id) As village_count"),
                    DB::raw('SUM(bee_keepers.old_beehive_count) As old_beehive_count'),
                    DB::raw('SUM(bee_keepers.new_beehive_count) As new_beehive_count'),
                    DB::raw('COUNT(bee_keepers.id) As beehive_count'),
                    DB::raw('COUNT(DISTINCT (bee_keepers.farmer_id)) As farmer_count'),
                    DB::raw('SUM(bee_keepers.annual_new_product_beehive + bee_keepers.annual_old_product_beehive) As total_product'))
                    ->join('area_translations', 'bee_keepers.area_id', '=', 'area_translations.id')
                    ->join('farmers', 'bee_keepers.farmer_id', '=', 'farmers.id')
                    ->join('state_translations', 'bee_keepers.state_id', '=', 'state_translations.id')
                    ->join('village_translations', 'bee_keepers.village_id', '=', 'village_translations.id')
                    ->where('area_translations.name', $area_name)
                    ->where('state_translations.name', $state_name)
                    ->where('bee_keepers.supported_side', $supported_side)
                    ->GroupBy('Area', 'State', 'village', 'supported_side', 'farmer_name'
                    )->get();
                return view('dashboard.admin.beekeepers.beekeepers_statistics', compact('admin', 'statistics'));

            } elseif ($request->area_id != null && $request->state_id != null && $request->village_id == null
                && $request->supported_side == null) {
                $statistics = BeeKeeper::select('area_translations.name AS Area',
                    'state_translations.name AS State', 'village_translations.name AS village',
                    'bee_keepers.supported_side as supported_side', 'farmers.firstname As farmer_name',
                    DB::raw("COUNT(bee_keepers.village_id) As village_count"),
                    DB::raw('SUM(bee_keepers.old_beehive_count) As old_beehive_count'),
                    DB::raw('SUM(bee_keepers.new_beehive_count) As new_beehive_count'),
                    DB::raw('COUNT(bee_keepers.id) As beehive_count'),
                    DB::raw('COUNT(DISTINCT (bee_keepers.farmer_id)) As farmer_count'),
                    DB::raw('SUM(bee_keepers.annual_new_product_beehive + bee_keepers.annual_old_product_beehive) As total_product'))
                    ->join('area_translations', 'bee_keepers.area_id', '=', 'area_translations.id')
                    ->join('farmers', 'bee_keepers.farmer_id', '=', 'farmers.id')
                    ->join('state_translations', 'bee_keepers.state_id', '=', 'state_translations.id')
                    ->join('village_translations', 'bee_keepers.village_id', '=', 'village_translations.id')
                    ->where('area_translations.name', $area_name)
                    ->where('state_translations.name', $state_name)
                    ->GroupBy('Area', 'State', 'village', 'supported_side', 'farmer_name'
                    )->get();
                return view('dashboard.admin.beekeepers.beekeepers_statistics', compact('admin', 'statistics'));

            }
        }

    }

}