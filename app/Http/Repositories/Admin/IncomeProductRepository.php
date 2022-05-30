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
        $dep_name = $adminDepartment->name;
        return view('dashboard.admin.income_products.index',compact('admin','dep_name')) ;
    }

    public function data()
    {
        $adminID = Auth::user()->id;
        $admin=Admin::findorfail($adminID);
        if($admin->type =='employee') {
            $incomes = IncomeProduct::with( 'country', 'whole_product','admin','unit','currency')
                ->where('admin_id',  $admin->id);
        }else{
            $incomes = IncomeProduct::with( 'country', 'whole_product','admin','unit','currency');

       }
        return DataTables::of($incomes)
            ->addColumn('record_select', 'dashboard.admin.income_products.data_table.record_select')
            ->addIndexColumn()
            ->editColumn('created_at', function (IncomeProduct $income) {
                return $income ->created_at->diffforhumans();
            })
            ->editColumn('admin', function (IncomeProduct $income) {
                return $income->admin->firstname;
            })
            ->addColumn('country', function (IncomeProduct $income) {
                return $income->country->name;
            })
            ->editColumn('country_product_type', function (IncomeProduct $income) {
                return view('dashboard.admin.income_products.data_table.country_product_type', compact('income'));


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
        $admin_dep_name = $admin->adminDepartment->name;
        $countries = Country::all();
        $whole_products = WholeProduct::all();
        $currencies = Currency::all();
        $units = Unit::all();


        return view('dashboard.admin.income_products.create',
            compact( 'admin','whole_products','countries','admin_dep_name','units','currencies','adminID'));
    }

    public function store($request) {
        try {
            $requestData = $request->validated();
            $income_product = new IncomeProduct();
            $income_product->admin_id =  $requestData['admin_id'];
            $income_product->country_id = $requestData['country_id'];

            $income_product->country_product_type = $requestData['country_product_type'];

            $income_product->whole_product_id = $requestData['whole_product_id'];

            $income_product->unit_id = $requestData['unit_id'];
            $income_product->currency_id = $requestData['currency_id'];
            $income_product->admin_dep_name = $request->admin_dep_name;

            $income_product->income_product_amount = $requestData['income_product_amount'];
            $income_product->income_product_price = $requestData['income_product_price'];
            $income_product->income_product_date = $requestData['income_product_date'];



            $income_product->save($requestData);

            toastr()->success(__('Admin/site.added_successfully'));
            return redirect()->route('IncomeProducts.index');


        } catch (\Exception $e) {
            toastr()->success(__('Admin/attributes.add_wrong'));

            return redirect()->back();
        }
    }

    public function show($id) {
        //
    }

    public function edit($id)
    {
        $outID = Crypt::decrypt($id);
        $countries = Country::all();
        $whole_products = WholeProduct::all();

        $income_product  = IncomeProduct::findorfail($outID);
        $adminID = Auth::user()->id;
        $admin = Admin::findorfail($adminID);
        $admin_dep_name = $admin->adminDepartment->name;

        $units = Unit::all();
        $currencies = Currency::all();

        return view('dashboard.admin.income_products.edit',
            compact('admin_dep_name','countries', 'units','adminID',
                'income_product','whole_products','currencies','admin'));
    }



    public function update( $request, $id) {
        try {
            $InID = Crypt::decrypt($id);
            $requestData = $request->validated();
            $income_product = IncomeProduct::findorfail($InID);
            $income_product->admin_id =  $requestData['admin_id'];


            $income_product->country_id = $requestData['country_id'];
            $income_product->unit_id = $requestData['unit_id'];
            $income_product->country_product_type = $requestData['country_product_type'];


            $income_product->admin_dep_name = $request->admin_dep_name;
            $income_product->income_product_price = $requestData['income_product_price'];
            $income_product->income_product_date = $requestData['income_product_date'];



            $income_product->update($requestData);

            toastr()->success(__('Admin/site.updated_successfully'));
            return redirect()->route('IncomeProducts.index');


        } catch (\Exception $e) {
            toastr()->success(__('Admin/attributes.edit_wrong'));
            return redirect()->back();
        }
    }

    public function destroy($id) {
        try{
            $InID = Crypt::decrypt($id);
            $income_product = IncomeProduct::findorfail($InID);


            $income_product->delete();
            toastr()->success(__('Admin/site.deleted_successfully'));
            return redirect()->route('IncomeProducts.index');
        }catch (\Exception $e) {
            toastr()->success(__('Admin/attributes.delete_wrong'));
            return redirect()->back();
        }


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
            toastr()->success(__('Admin/attributes.delete_wrong'));

            return redirect()->back();

        }


    }// end of bulkDelete


    public function income_product_statistics(){
        $statistics = IncomeProduct::select('country_translations.name AS country',
            'income_products.admin_dep_name AS admin_dep_name',
            'whole_product_translations.name as product_name',
            'income_products.income_product_amount as income_product_amount',
            'income_products.income_product_price as income_product_price',
            'income_products.country_product_type as country_product_type',
            'income_products.income_product_date as income_product_date')


            ->join('country_translations', 'income_products.country_id', '=', 'country_translations.id')
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
                ->where('admin_id',  $admin->id)->get();
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
        $income_products = $income_productQuery->select('country_translations.name as country',
            'whole_product_translations.name AS Product','income_products.admin_dep_name as admin_dep_name'
            , DB::raw('SUM(CASE WHEN income_products.country_product_type = "local" THEN income_products.income_product_amount ELSE 0 END )AS local_product')
            , DB::raw('SUM(CASE WHEN income_products.country_product_type = "iraq" THEN income_products.income_product_amount ELSE 0 END )AS iraq_product')
            , DB::raw('SUM(CASE WHEN (income_products.country_product_type = "imported")  THEN income_products.income_product_amount ELSE 0 END )AS imported_product')

           , 'income_products.income_product_date AS date')
            ->join('country_translations', 'income_products.country_id', '=', 'country_translations.id')
            ->join('whole_product_translations', 'income_products.whole_product_id', '=', 'whole_product_translations.id')

            ->groupBy ('country','Product','date','admin_dep_name')->get();
        return datatables()->of($income_products)
            ->make(true);
    }

    public function index_income_local_products(){
        return view('dashboard.admin.income_products.weekly_monthly_anual_local_statistics');
    }
    public function get_weekly_monthly_anual_income_local_product_statistics()
    {
        $income_productQueryfirst = IncomeProduct::query();
        $adminID = Auth::user()->id;
        $admin = Admin::findorfail($adminID);
        if ($admin->type == 'employee') {
            $income_productQuery = $income_productQueryfirst
                ->where('admin_id', $admin->id)->get();
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
        $income_products = $income_productQuery->select('country_translations.name as country',
            'whole_product_translations.name AS Product','income_products.admin_dep_name as admin_dep_name',
             DB::raw('SUM(income_products.income_product_amount)AS local_product')
            , 'income_products.income_product_date AS date')
            ->join('country_translations', 'income_products.country_id', '=', 'country_translations.id')
            ->join('whole_product_translations', 'income_products.whole_product_id', '=', 'whole_product_translations.id')
            ->where('income_products.country_product_type','local')
            ->groupBy ('country','Product','date','admin_dep_name')->get();
        return datatables()->of($income_products)
            ->make(true);
    }


    public function index_income_iraq_products(){
        return view('dashboard.admin.income_products.weekly_monthly_anual_iraq_statistics');
    }
    public function get_weekly_monthly_anual_income_iraq_product_statistics()
    {
        $income_productQueryfirst = IncomeProduct::query();
        $adminID = Auth::user()->id;
        $admin = Admin::findorfail($adminID);
        if ($admin->type == 'employee') {
            $income_productQuery = $income_productQueryfirst
                ->where('admin_id',  $admin->id)->get();
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
        $income_products = $income_productQuery->select('country_translations.name as country',
            'whole_product_translations.name AS Product','income_products.admin_dep_name as admin_dep_name',
            DB::raw('SUM(income_products.income_product_amount)AS iraq_product')

            , 'income_products.income_product_date AS date')
            ->join('country_translations', 'income_products.country_id', '=', 'country_translations.id')
            ->join('whole_product_translations', 'income_products.whole_product_id', '=', 'whole_product_translations.id')
            ->where('income_products.country_product_type','iraq')

            ->groupBy ('country','Product','date','admin_dep_name')->get();
        return datatables()->of($income_products)
            ->make(true);
    }

    public function index_income_imported_products(){
        return view('dashboard.admin.income_products.weekly_monthly_anual_imported_statistics');
    }
    public function get_weekly_monthly_anual_income_imported_product_statistics()
    {
        $income_productQueryfirst = IncomeProduct::query();
        $adminID = Auth::user()->id;
        $admin = Admin::findorfail($adminID);
        if ($admin->type == 'employee') {
            $income_productQuery = $income_productQueryfirst
                ->where('admin_id', $admin->id)->get();
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
        $income_products = $income_productQuery->select('country_translations.name as country',
            'whole_product_translations.name AS Product','income_products.admin_dep_name as admin_dep_name',
        DB::raw('SUM(income_products.income_product_amount)AS imported_product')

            , 'income_products.income_product_date AS date')
            ->join('country_translations', 'income_products.country_id', '=', 'country_translations.id')
            ->join('whole_product_translations', 'income_products.whole_product_id', '=', 'whole_product_translations.id')
            ->where('income_products.country_product_type','imported')

            ->groupBy ('country','Product','date','admin_dep_name')->get();
        return datatables()->of($income_products)
            ->make(true);
    }
}