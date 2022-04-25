<?php
namespace  App\Http\Repositories\Admin;
use App\Http\Interfaces\Admin\OutcomeProductInterface;
use App\Models\Currency;
use App\Models\OutcomeProduct;
use App\Models\Admin;
use App\Models\Area;
use App\Models\State;
use App\Models\Country;
use App\Models\Province;
use App\Models\WholeProduct;
use App\Models\Unit;
use App\Models\AdminDepartment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use App\Traits\UploadT;
use Illuminate\Http\Request;
use Auth;
use Yajra\DataTables\DataTables;

class OutcomeProductRepository implements OutcomeProductInterface {
    public function index() {
        return view('dashboard.admin.outcome_products.index') ;
    }

    public function data()
    {
        $outcomes = OutcomeProduct::with('area','country','province','adminDepartment','whole_product');

        return DataTables::of($outcomes)
            ->addColumn('record_select', 'dashboard.admin.outcome_products.data_table.record_select')
            ->addIndexColumn()
            ->editColumn('created_at', function (OutcomeProduct $outcome) {
                return $outcome ->created_at->diffforhumans();
            })
            ->addColumn('country', function (OutcomeProduct $outcome) {
                return $outcome->country->name;
            })
            ->addColumn('province', function (OutcomeProduct $outcome) {
                if(!empty($outcome->province)){
                    return $outcome->province->name;
                }else{
                    return null;
                }

            })
            ->addColumn('area', function (OutcomeProduct $outcome) {
                if(!empty($outcome->area)){
                    return $outcome->area->name;
                }else{
                    return null;
                }
            })
            ->addColumn('adminDepartment', function (OutcomeProduct $outcome) {
                return $outcome->adminDepartment->dep_name_ar;
            })
            ->addColumn('whole_product', function (OutcomeProduct $outcome) {
                return $outcome->whole_product->name;
            })



            ->addColumn('actions', 'dashboard.admin.outcome_products.data_table.actions')
            ->rawColumns(['record_select', 'actions'])
            ->toJson();

    }

    public function create() {
        $areas = Area::all();
        $provinces = Province::all();
        $countries = Country::all();

        $whole_products = WholeProduct::all();
        $admin_dpartments = AdminDepartment::all();
        $currencies = Currency::all();

        $units = Unit::all();


        return view('dashboard.admin.outcome_products.create',
            compact( 'whole_products', 'areas', 'provinces', 'countries','admin_dpartments','units','currencies'));
    }

    public function store($request) {
        DB::beginTransaction();
        try {
            $requestData = $request->validated();
            $outcome_product = new OutcomeProduct();
            $outcome_product->admin_id = Auth::user()->id;
            $outcome_product->country_id = $requestData['country_id'];

            if(!empty($outcome_product->area_id)){
                $outcome_product->area_id = $requestData['area_id'];
            }else{
                $outcome_product->area_id = null;
            }
            if(!empty($outcome_product->province_id)){
                $outcome_product->province_id = $requestData['province_id'];
            }else{
                $outcome_product->province_id = null;
            }
            $outcome_product->whole_product_id = $requestData['whole_product_id'];

            $outcome_product->unit_id = $requestData['unit_id'];
            $outcome_product->currency_id = $requestData['currency_id'];

            $outcome_product->admin_department_id = $requestData['admin_department_id'];
            $outcome_product->outcome_product_amount = $requestData['outcome_product_amount'];
            $outcome_product->outcome_product_price = $requestData['outcome_product_price'];
            $outcome_product->outcome_product_date = $requestData['outcome_product_date'];



            $outcome_product->save($requestData);

            DB::commit();
            toastr()->success(__('Admin/site.added_successfully'));
            return redirect()->route('OutcomeProducts.index');


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
        $outID = Crypt::decrypt($id);
        $areas = Area::all();
        $countries = Country::all();
        $provinces = Province::all();
        $whole_products = WholeProduct::all();

        $outcome_product  = OutcomeProduct::findorfail($outID);
        $admins = Admin::all();
        $admin_dpartments = AdminDepartment::all();
        $units = Unit::all();
        $currencies = Currency::all();

        return view('dashboard.admin.outcome_products.edit',
            compact('admin_dpartments', 'areas', 'provinces','countries', 'units',
                'outcome_product','whole_products','currencies'));
    }



    public function update( $request, $id) {
        DB::beginTransaction();
        try {
            $outID = Crypt::decrypt($id);
            $requestData = $request->validated();
            $outcome_product = OutcomeProduct::findorfail($outID);
            $outcome_product->admin_id = Auth::user()->id;
            if(!empty($outcome_product->area_id)){
                $outcome_product->area_id = $requestData['area_id'];
            }else{
                $outcome_product->area_id = null;
            }
            if(!empty($outcome_product->province_id)){
                $outcome_product->province_id = $requestData['province_id'];
            }else{
                $outcome_product->province_id = null;
            }

            $outcome_product->country_id = $requestData['country_id'];
            $outcome_product->unit_id = $requestData['unit_id'];
            $outcome_product->currency_id = $requestData['currency_id'];

            $outcome_product->outcome_product_amount = $requestData['outcome_product_amount'];
            $outcome_product->outcome_product_price = $requestData['outcome_product_price'];
            $outcome_product->outcome_product_date = $requestData['outcome_product_date'];



            $outcome_product->update($requestData);

            DB::commit();
            toastr()->success(__('Admin/site.updated_successfully'));
            return redirect()->route('OutcomeProducts.index');


        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['Error' => $e->getMessage()]);
        }
    }

    public function destroy($id) {
        $outID = Crypt::decrypt($id);
        $outcome_product = OutcomeProduct::findorfail($outID);


        $outcome_product->delete();
        toastr()->success(__('Admin/site.deleted_successfully'));
        return redirect()->route('OutcomeProducts.index');

    }

    public function bulkDelete($request) {
        try {
            DB::beginTransaction();
            if ($request->delete_select_id) {
                $delete_select_id = explode(",", $request->delete_select_id);
                foreach ($delete_select_id as $outID) {

                    $outcome_product = OutcomeProduct::findorfail($outID);


                    OutcomeProduct::destroy($outID);
                }
                DB::commit();

                toastr()->error(__('Admin/site.deleted_successfully'));
                return redirect()->route('OutcomeProducts.index');
            } else {
                toastr()->error(__('Admin/site.no_data_found'));
                return redirect()->route('OutcomeProducts.index');
            }
        }catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);

        }


    }// end of bulkDelete
}