<?php
namespace  App\Http\Repositories\Admin;
use App\Http\Interfaces\Admin\IncomeProductInterface;
use App\Models\IncomeProduct;
use App\Models\Admin;
use App\Models\Country;
use App\Models\Province;
use App\Models\Area;
use App\Models\WholeProduct;
use App\Models\Currency;

use App\Models\State;
use App\Models\Unit;

use App\Models\AdminDepartment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use App\Traits\UploadT;
use Illuminate\Http\Request;
use Auth;
use Yajra\DataTables\DataTables;

class IncomeProductRepository implements IncomeProductInterface {
    public function index() {
        $adminID = Auth::user()->id;
        $admin = Admin::findorfail($adminID);
        $department_id = $admin->adminDepartment->id;
        $adminDepartment = AdminDepartment::findorfail($department_id);
        $dep_name = $adminDepartment->dep_name_ar;
        return view('dashboard.admin.income_products.index',compact('admin','dep_name')) ;
    }

    public function data()
    {
        $adminID = Auth::user()->id;
        $admin=Admin::findorfail($adminID);
        if($admin->type =='employee') {
            $incomes = IncomeProduct::with('area', 'country', 'province', 'whole_product','admin')
                ->where('admin_id', '==', $admin->id);
        }else{
            $incomes = IncomeProduct::with('area', 'country', 'province', 'whole_product','admin');

        }
        return DataTables::of($incomes)
            ->addColumn('record_select', 'dashboard.admin.income_products.data_table.record_select')
            ->addIndexColumn()
            ->editColumn('created_at', function (IncomeProduct $income) {
                return $income ->created_at->diffforhumans();
            })
            ->editColumn('admin', function (IncomeProduct $income) {
                return $income ->admin->firstname;
            })
            ->addColumn('country', function (IncomeProduct $income) {
                return $income->country->name;
            })
            ->addColumn('province', function (IncomeProduct $income) {
                if(!empty($income->province)){
                    return $income->province->name;
                }else{
                    return null;
                }

            })
            ->addColumn('area', function (IncomeProduct $income) {
                if(!empty($income->area)){
                    return $income->area->name;
                }else{
                    return null;
                }
            })

            ->addColumn('whole_product', function (IncomeProduct $income) {
                return $income->whole_product->name;
            })
            ->addColumn('currency', function (IncomeProduct $income) {
                return $income->currency->Name;
            })



            ->addColumn('actions', 'dashboard.admin.income_products.data_table.actions')
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


        return view('dashboard.admin.income_products.create',
            compact( 'admin','whole_products', 'areas', 'provinces', 'countries','$admin_dep_name','units','currencies'));
    }

    public function store($request) {
        DB::beginTransaction();
        try {
            $requestData = $request->validated();
            $income_product = new IncomeProduct();
            $income_product->admin_id = Auth::user()->id;
            $income_product->country_id = $requestData['country_id'];

            if(!empty($income_product->area_id)){
                $income_product->area_id = $requestData['area_id'];
            }else{
                $income_product->area_id = null;
            }
            if(!empty($income_product->province_id)){
                $income_product->province_id = $requestData['province_id'];
            }else{
                $income_product->province_id = null;
            }
            $income_product->whole_product_id = $requestData['whole_product_id'];

            $income_product->unit_id = $requestData['unit_id'];
            $income_product->currency_id = $requestData['currency_id'];
            $income_product->admin_dep_name = $request->admin_dep_name;

            $income_product->income_product_amount = $requestData['income_product_amount'];
            $income_product->income_product_price = $requestData['income_product_price'];
            $income_product->income_product_date = $requestData['income_product_date'];



            $income_product->save($requestData);

            DB::commit();
            toastr()->success(__('Admin/site.added_successfully'));
            return redirect()->route('IncomeProducts.index');


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

        $income_product  = IncomeProduct::findorfail($outID);
        $adminID = Auth::user()->id;
        $admin = Admin::findorfail($adminID);
        $admin_dep_name = $admin->adminDepartment->dep_name_ar;

        $units = Unit::all();
        $currencies = Currency::all();

        return view('dashboard.admin.income_products.edit',
            compact('admin_dep_name', 'areas', 'provinces','countries', 'units',
                'income_product','whole_products','currencies','admin'));
    }



    public function update( $request, $id) {
        DB::beginTransaction();
        try {
            $InID = Crypt::decrypt($id);
            $requestData = $request->validated();
            $income_product = IncomeProduct::findorfail($InID);
            $income_product->admin_id = Auth::user()->id;
            if(!empty($income_product->area_id)){
                $income_product->area_id = $requestData['area_id'];
            }else{
                $income_product->area_id = null;
            }
            if(!empty($income_product->province_id)){
                $income_product->province_id = $requestData['province_id'];
            }else{
                $income_product->province_id = null;
            }

            $income_product->country_id = $requestData['country_id'];
            $income_product->unit_id = $requestData['unit_id'];


            $income_product->admin_dep_name = $request->admin_dep_name;
            $income_product->income_product_price = $requestData['income_product_price'];
            $income_product->income_product_date = $requestData['income_product_date'];



            $income_product->update($requestData);

            DB::commit();
            toastr()->success(__('Admin/site.updated_successfully'));
            return redirect()->route('IncomeProducts.index');


        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['Error' => $e->getMessage()]);
        }
    }

    public function destroy($id) {
        $InID = Crypt::decrypt($id);
        $income_product = IncomeProduct::findorfail($InID);


        $income_product->delete();
        toastr()->success(__('Admin/site.deleted_successfully'));
        return redirect()->route('IncomeProducts.index');

    }

    public function bulkDelete($request) {
        try {
            DB::beginTransaction();
            if ($request->delete_select_id) {
                $delete_select_id = explode(",", $request->delete_select_id);
                foreach ($delete_select_id as $InID) {

                    $income_product = IncomeProduct::findorfail($InID);


                    IncomeProduct::destroy($InID);
                }
                DB::commit();

                toastr()->error(__('Admin/site.deleted_successfully'));
                return redirect()->route('IncomeProducts.index');
            } else {
                toastr()->error(__('Admin/site.no_data_found'));
                return redirect()->route('IncomeProducts.index');
            }
        }catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);

        }


    }// end of bulkDelete


    public function income_product_statistics(){
        $statistics = IncomeProduct::select('country_translations.name AS country','province_translations.name AS province',
            'income_products.admin_dep_name AS admin_dep_name as dep_name','whole_product_translations.name as product_name',
            'income_products.income_product_amount as income_product_amount',
            'income_products.income_product_price as income_product_price','income_products.income_product_date as income_product_date')


            ->join('country_translations', 'income_products.country_id', '=', 'country_translations.id')
            ->join('province_translations', 'income_products.province_id', '=', 'province_translations.id')
            ->join('whole_product_translations','income_products.whole_product_id','=','whole_product_translations.id')
            ->get();

        return view('dashboard.admin.income_products.income_products_statistics',compact('statistics'));

    }
    public function index_income_products(){
        return view('dashboard.admin.income_products.weekly_monthly_anual_statistics');
    }

    public function get_weekly_monthly_anual_income_product_statistics()
    {
        $income_productQueryfirst = IncomeProduct::query();
        $adminID = Auth::user()->id;
        $admin = Admin::findorfail($adminID);
        if ($admin->type == 'employee') {
            $income_productQuery = $income_productQueryfirst
                ->where('admin_id', '==', $admin->id)->get();
        } else {
            $income_productQuery = $income_productQueryfirst;
        }

        $start_date = (!empty($_GET["start_date"])) ? ($_GET["start_date"]) : ('');
        $end_date = (!empty($_GET["end_date"])) ? ($_GET["end_date"]) : ('');

        if ($start_date && $end_date) {

            $start_date = date('Y-m-d', strtotime($start_date));
            $end_date = date('Y-m-d', strtotime($end_date));

            $income_productQuery->whereRaw("date(income_products.income_product_date) >= '" . $start_date . "' AND date(income_products.income_product_date) <= '" . $end_date . "'");
        }
        $income_products = $income_productQuery->select(
            'whole_product_translations.name AS Product','income_products.admin_dep_name as admin_dep_name'
            , DB::raw('SUM(CASE WHEN country_translations.name = "كردستان" THEN income_products.income_product_amount ELSE 0 END )AS local_product')
            , DB::raw('SUM(CASE WHEN country_translations.name = "العراق" THEN income_products.income_product_amount ELSE 0 END )AS iraq_product')
            , DB::raw('SUM(CASE WHEN (country_translations.name != "العراق" && country_translations.name != "كردستان")  THEN income_products.income_product_amount ELSE 0 END )AS imported_product')

           , 'income_products.income_product_date AS date')
            ->join('country_translations', 'income_products.country_id', '=', 'country_translations.id')
            ->join('whole_product_translations', 'income_products.whole_product_id', '=', 'whole_product_translations.id')

            ->groupBy ('Product','date','admin_dep_name')->get();
        return datatables()->of($income_products)
            ->make(true);
    }
}