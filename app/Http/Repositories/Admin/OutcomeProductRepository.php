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
        $adminID = Auth::user()->id;
        $admin = Admin::findorfail($adminID);
        $department_id = $admin->adminDepartment->id;
        $adminDepartment = AdminDepartment::findorfail($department_id);
        $dep_name = $adminDepartment->dep_name_ar;
        return view('dashboard.admin.outcome_products.index',compact('admin','dep_name')) ;
    }

    public function data()
    {
        $adminID = Auth::user()->id;
        $admin=Admin::findorfail($adminID);
        if($admin->type =='employee') {
            $outcomes = OutcomeProduct::with('area', 'country', 'province', 'whole_product', 'admin','currency')
                ->where('admin_id', '==', $admin->id);
        }else{
            $outcomes = OutcomeProduct::with('area', 'country', 'province', 'whole_product', 'admin','currency');

        }

        return DataTables::of($outcomes)
            ->addColumn('record_select', 'dashboard.admin.outcome_products.data_table.record_select')
            ->addIndexColumn()
            ->editColumn('created_at', function (OutcomeProduct $outcome) {
                return $outcome ->created_at->diffforhumans();
            })
            ->editColumn('admin', function (OutcomeProduct $outcome) {
                return $outcome ->admin->firstname;
            })
            ->addColumn('country', function (OutcomeProduct $outcome) {
                return $outcome->country->name;
            })
            ->addColumn('currency', function (OutcomeProduct $outcome) {
                return $outcome->currency->Name;
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

            ->addColumn('whole_product', function (OutcomeProduct $outcome) {
                return $outcome->whole_product->name;
            })



            ->addColumn('actions', 'dashboard.admin.outcome_products.data_table.actions')
            ->rawColumns(['record_select', 'actions'])
            ->toJson();

    }

    public function create() {
        $adminID = Auth::user()->id;
        $admin = Admin::findorfail($adminID);
        $department_id = $admin->adminDepartment->id;

        $admin_dep_name = $admin->adminDepartment->dep_name_ar;
        $areas = Area::all();
        $provinces = Province::all();
        $countries = Country::all();

        $whole_products = WholeProduct::all();
        $currencies = Currency::all();

        $units = Unit::all();


        return view('dashboard.admin.outcome_products.create',
            compact( 'admin','admin_dep_name','whole_products', 'areas', 'provinces', 'countries','units','currencies'));
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
            $outcome_product->admin_dep_name = $request->admin_dep_name;

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
        $outcome_product = OutcomeProduct::findorfail($outID);
        $adminID = Auth::user()->id;
        $admin = Admin::findorfail($adminID);
        $department_id = $admin->adminDepartment->id;
        $admin_dep_name = $admin->adminDepartment->dep_name_ar;
        $areas = Area::all();
        $provinces = Province::all();
        $countries = Country::all();
        $whole_products = WholeProduct::all();
        $currencies = Currency::all();
        $units = Unit::all();

        return view('dashboard.admin.outcome_products.edit',
            compact('admin_dep_name', 'areas', 'provinces','countries', 'units','dep_name',
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
            $outcome_product->admin_dep_name = $request->admin_dep_name;

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


    public function outcome_product_statistics(){
        $statistics = OutcomeProduct::select('country_translations.name AS country','province_translations.name AS province',
            'outcome_products.admin_dep_name AS admin_dep_name as dep_name','whole_product_translations.name as product_name',
            'outcome_products.outcome_product_amount as outcome_product_amount',
            'outcome_products.outcome_product_price as outcome_product_price','outcome_products.outcome_product_date as outcome_product_date')


            ->join('country_translations', 'outcome_products.country_id', '=', 'country_translations.id')
            ->join('province_translations', 'outcome_products.province_id', '=', 'province_translations.id')
            ->join('whole_product_translations','outcome_products.whole_product_id','=','whole_product_translations.id')
            ->get();

        return view('dashboard.admin.outcome_products.outcome_products_statistics',compact('statistics'));

    }
}