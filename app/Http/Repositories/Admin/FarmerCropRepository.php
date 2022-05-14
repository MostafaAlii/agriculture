<?php
namespace  App\Http\Repositories\Admin;
use App\Http\Interfaces\Admin\FarmerCropInterface;
use App\Models\Farmer;
use App\Models\Admin;
use App\Models\Area;
use App\Models\State;
use App\Models\Village;
use App\Models\Crop;
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
        return view('dashboard.admin.farmer_crops.index');


    }

    public function data()
    {
        $farmerCrops = FarmerCrop::with(['crops','farmer','village','landCategory']);

        return DataTables::of($farmerCrops)
            ->addColumn('record_select', 'dashboard.admin.farmer_crops.data_table.record_select')
            ->addIndexColumn()
            ->editColumn('created_at', function (FarmerCrop $chard) {
                return $chard ->created_at->diffforhumans();
            })
            ->addColumn('farmer', function (FarmerCrop $chard) {
                return $chard ->farmer->email;
            })
            ->addColumn('village', function (FarmerCrop $chard) {
                return $chard->village->name;
            })


            ->addColumn('actions', 'dashboard.admin.farmer_crops.data_table.actions')
            ->rawColumns(['record_select', 'actions'])
            ->toJson();

    }

    public function create() {
        $crops = Crop::all();
        $land_categories = LandCategory::all();
        $villages=Village::all();
        $farmers = Farmer::all();
        $areas= Area::all();
        $states = State::all();
        return view('dashboard.admin.farmer_crops.create'
            ,compact('areas','land_categories','crops')
        );
    }


    public function edit($id)
    {
        $land_categories = LandCategory::all();
        $villages=Village::all();
        $farmers = Farmer::all();
        $areas= Area::all();
        $states = State::all();
        $farmerCrop = FarmerCrop::findorfail($id)->first();
//        abort_if(Gate::denies('farmer_crop_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $farmerCrop->load('crops');

        $crops = Crop::get()->map(function($crop) use ($farmerCrop) {
            $crop->value = data_get($farmerCrop->crops->firstWhere('id', $crop->id), 'pivot.area') ?? null;
            return $crop;
        });

        return view('dashboard.admin.farmer_crops.edit', compact('crops','farmerCrop','land_categories',
            'farmers','areas','states','villages'));
    }

    public function show($id) {
        //
    }

    public function store( $request)
    {
        DB::beginTransaction();
        try {
            $requestData = $request->validated();
            $farmerCrop = new FarmerCrop();
            $farmerCrop->admin_id = Auth::user()->id;
            $farmerCrop->farmer_id = $requestData['farmer_id'];
            $farmerCrop->area_id = $requestData['area_id'];
            $farmerCrop->state_id = $requestData['state_id'];
            $farmerCrop->village_id = $requestData['village_id'];
            $farmerCrop->land_category_id = $requestData['land_category_id'];
            $farmerCrop->phone = $requestData['phone'];
            $farmerCrop->email = $requestData['email'];


            $farmerCrop->save($requestData);
            $farmerCrop->crops()->sync($this->mapCrops($requestData['crops']));
            DB::commit();
            toastr()->success(__('Admin/site.added_successfully'));
            return redirect()->route('FarmerCrops.index');


        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['Error' => $e->getMessage()]);
        }


    }

    public function update( $request,$id)
    {
//        return $request;
        $requestData = $request->validated();
        $farmerCrop = FarmerCrop::findorFail($id);
        $farmerCrop->update($requestData);
      $farmerCrop->crops()->sync($this->mapCrops($requestData['crops']));

        return redirect()->route('dashboard.admin.farmer_crops.index');


    }

    private function mapCrops($crops)
    {
        return collect($crops)->map(function ($i) {
            return ['area' => $i];
        });
    }


}