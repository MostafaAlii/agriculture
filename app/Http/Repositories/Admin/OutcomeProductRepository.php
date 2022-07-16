<?php
namespace  App\Http\Repositories\Admin;
use App\Http\Interfaces\Admin\OutcomeProductInterface;
use App\Models\Currency;
use App\Models\OutcomeProduct;
use App\Models\Admin;
use App\Models\Area;
use App\Models\State;
use App\Models\Country;
use App\Models\CountryTranslation;
use App\Models\WholesaleTranslation;
use App\Models\Province;
use App\Models\WholeProduct;
use App\Models\WholeProductTranslation;

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
        if ($admin->area == Null && $admin->state == null) {
            toastr()->error(__('Admin/services.index-wrong'));

            return redirect()->back();
        } else {
            $department_id = $admin->adminDepartment->id;
            $adminDepartment = AdminDepartment::findorfail($department_id);
            $dep_name = $adminDepartment->name;
            return view('dashboard.admin.outcome_products.index',compact('admin','dep_name')) ;
        }

    }

    public function data()
    {
        $adminID = Auth::user()->id;
        $admin=Admin::findorfail($adminID);
        if($admin->type =='employee') {
            $outcomes = OutcomeProduct::with( 'country','whole_product', 'admin','currency','wholesale')
                ->where('admin_id',  $admin->id)->get();
        }else{
            $outcomes = OutcomeProduct::with('country', 'whole_product', 'admin','currency')->get();

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
            ->addColumn('wholesale', function (OutcomeProduct $outcome) {
                return $outcome->wholesale->Name;
            })
            ->addColumn('product', function (OutcomeProduct $outcome) {
                return $outcome->whole_product->name;
            })
            ->addColumn('currency', function (OutcomeProduct $outcome) {
                return $outcome->currency->Name;
            })


            ->addColumn('whole_product', function (OutcomeProduct $outcome) {
                return $outcome->whole_product->name;
            })
            ->editColumn('country_product_type', function (OutcomeProduct $outcome) {
                return view('dashboard.admin.outcome_products.data_table.country_product_type', compact('outcome'));


            })


            ->addColumn('actions', 'dashboard.admin.outcome_products.data_table.actions')
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


        return view('dashboard.admin.outcome_products.create',
            compact( 'admin','admin_dep_name','whole_products',  'countries','units','currencies','adminID'));
    }

    public function store($request) {
        try {
            $requestData = $request->validated();
            $outcome_product = new OutcomeProduct();
            $outcome_product->admin_id =  $requestData['admin_id'];
            $outcome_product->country_id = $requestData['country_id'];

            $outcome_product->country_product_type = $requestData['country_product_type'];
            $outcome_product->whole_product_id = $requestData['whole_product_id'];

            $outcome_product->unit_id = $requestData['unit_id'];
            $outcome_product->currency_id = $requestData['currency_id'];
            $outcome_product->wholesale_id =$requestData['wholesale_id'];


            $outcome_product->outcome_product_amount = $requestData['outcome_product_amount'];
            $outcome_product->outcome_product_price = $requestData['outcome_product_price'];
            $outcome_product->outcome_product_date = $requestData['outcome_product_date'];



            $outcome_product->save($requestData);

            toastr()->success(__('Admin/site.added_successfully'));
            return redirect()->route('OutcomeProducts.index');


        } catch (\Exception $e) {
//            toastr()->error(__('Admin/attributes.add_wrong'));
//            return redirect()->back();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);

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
        $admin_dep_name = $admin->adminDepartment->name;

        $countries = Country::all();
        $whole_products = WholeProduct::all();
        $currencies = Currency::all();
        $units = Unit::all();

        return view('dashboard.admin.outcome_products.edit',
            compact('admin_dep_name', 'countries', 'units','adminID',
                'outcome_product','whole_products','currencies'));
    }



    public function update( $request, $id) {
        try {
            $outID = Crypt::decrypt($id);
            $requestData = $request->validated();
            $outcome_product = OutcomeProduct::findorfail($outID);
            $outcome_product->admin_id =  $requestData['admin_id'];
            $outcome_product->country_product_type = $requestData['country_product_type'];
            $outcome_product->country_id = $requestData['country_id'];
            $outcome_product->unit_id = $requestData['unit_id'];
            $outcome_product->currency_id = $requestData['currency_id'];
            $outcome_product->wholesale_id =$requestData['wholesale_id'];

            $outcome_product->outcome_product_amount = $requestData['outcome_product_amount'];
            $outcome_product->outcome_product_price = $requestData['outcome_product_price'];
            $outcome_product->outcome_product_date = $requestData['outcome_product_date'];



            $outcome_product->update($requestData);

            toastr()->success(__('Admin/site.updated_successfully'));
            return redirect()->route('OutcomeProducts.index');


        } catch (\Exception $e) {
            toastr()->error(__('Admin/attributes.edit_wrong'));
            return redirect()->back();
        }
    }

    public function destroy($id) {
        try{
            $outID = Crypt::decrypt($id);
            $outcome_product = OutcomeProduct::findorfail($outID);


            $outcome_product->delete();
            toastr()->success(__('Admin/site.deleted_successfully'));
            return redirect()->route('OutcomeProducts.index');
        }catch (\Exception $e) {
            toastr()->error(__('Admin/attributes.delete_wrong'));
            return redirect()->back();
        }


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
            toastr()->error(__('Admin/attributes.delete_wrong'));

            return redirect()->back();

        }


    }// end of bulkDelete

    public function index_outcome_products(){
        $adminID = Auth::user()->id;
        $admin = Admin::findorfail($adminID);

        return view('dashboard.admin.outcome_products.outcome_products_statistics',compact('admin'));
    }


    public function outcome_product_statistics($request)
    {

        $validated = $request->validate([

            'start_date' => 'sometimes|nullable|date',
            'end_date' => 'sometimes|nullable|date|after_or_equal:start_date',
            'country_id'=>'sometimes|nullable|exists:countries,id',
            'wholesale_id'=>'sometimes|nullable|exists:wholesales,id',
            'whole_product_id'=>'sometimes|nullable|exists:whole_products,id',
            'country_product_type'=>'sometimes|nullable|in:local,iraq,imported',
        ]
//            , [
//            'start_date.date' => trans('Admin/validation.date'),
//            'end_date.date' => trans('Admin/validation.date'),
//            'end_date.after_or_equal' => trans('Admin/validation.after_or_equal'),
//        ]
        );
        $adminID = Auth::user()->id;
        $admin = Admin::findorfail($adminID);
        $country_product_type = $request->country_product_type;

        if (!empty($request->country_id)) {
            $country_name = CountryTranslation::where('country_id', '=', $request->country_id)->pluck('name');

        }
        if (!empty($request->wholesale_id)) {
            $wholesale_name = WholesaleTranslation::where('wholesale_id', '=', $request->wholesale_id)->pluck('Name');

        }
        if (!empty($request->whole_product_id)) {
            $whole_product_name = WholeProductTranslation::where('whole_product_id', '=', $request->whole_product_id)->pluck('name');
        }


        $start_date = (!empty($_GET["start_date"])) ? ($_GET["start_date"]) : ('');
        $end_date = (!empty($_GET["end_date"])) ? ($_GET["end_date"]) : ('');


        $latests = \DB::table('farmer_crops')->orderBy('date', 'desc')->first();
        $oldest = \DB::table('farmer_crops')->orderBy('date', 'asc')->first();

        if ($admin->type == 'admin') {
            if ($request->country_id != null && $request->whole_product_id != null && $request->wholesale_id !=null &&
                $request->country_product_type != null && $request->start_date && $request->end_date)
            {
                $outcomeProductQuery1 = OutcomeProduct::query();

                $start_date = date('Y-m-d', strtotime($start_date));
                $end_date = date('Y-m-d', strtotime($end_date));
                $outcome_productQuery = $outcomeProductQuery1->whereRaw("date(outcome_products.outcome_product_date) >= '" . $request->start_date . "'
             AND date(outcome_products.outcome_product_date) <= '" . $request->end_date . "'");

                $outcome_products = $outcome_productQuery->select('country_translations.name as country',
                    'whole_product_translations.name AS Product', 'wholesale_translations.name as admin_dep_name',
                    'outcome_products.country_product_type as country_product_type'
                    , DB::raw('SUM(outcome_products.outcome_product_amount) as product_amount')
                    , 'outcome_products.outcome_product_date AS date')
                    ->join('wholesale_translations', 'outcome_products.wholesale_id', '=', 'wholesale_translations.id')

                    ->join('country_translations', 'outcome_products.country_id', '=', 'country_translations.id')
                    ->join('whole_product_translations', 'outcome_products.whole_product_id', '=', 'whole_product_translations.id')
                    ->where('whole_product_translations.name', $whole_product_name)
                    ->where('country_translations.name', $country_name)
                    ->where('country_product_type', $country_product_type)
                    ->where('wholesale_translations.Name', $wholesale_name)
                    ->groupBy('country', 'Product', 'country_product_type', 'date', 'admin_dep_name')->get();

                return view('dashboard.admin.outcome_products.outcome_products_statistics',
                    compact('outcome_products', 'admin'));

            }
            elseif ($request->country_id != null && $request->whole_product_id == null && $request->wholesale_id !=null &&
                $request->country_product_type == null && $request->start_date && $request->end_date)
            {
                $outcomeProductQuery1 = OutcomeProduct::query();

                $start_date = date('Y-m-d', strtotime($start_date));
                $end_date = date('Y-m-d', strtotime($end_date));
                $outcome_productQuery = $outcomeProductQuery1->whereRaw("date(outcome_products.outcome_product_date) >= '" . $request->start_date . "'
             AND date(outcome_products.outcome_product_date) <= '" . $request->end_date . "'");


                $outcome_products = $outcome_productQuery->select('country_translations.name as country',
                    'whole_product_translations.name AS Product', 'wholesale_translations.Name as admin_dep_name',
                    'outcome_products.country_product_type as country_product_type'
                    , DB::raw('SUM(outcome_products.outcome_product_amount) as product_amount')
                    , 'outcome_products.outcome_product_date AS date')
                    ->join('wholesale_translations', 'outcome_products.wholesale_id', '=', 'wholesale_translations.id')

                    ->join('country_translations', 'outcome_products.country_id', '=', 'country_translations.id')
                    ->join('whole_product_translations', 'outcome_products.whole_product_id', '=', 'whole_product_translations.id')
                    ->where('country_translations.name', $country_name)
                    ->where('wholesale_translations.Name', $wholesale_name)
                    ->groupBy('country', 'Product', 'country_product_type', 'date', 'admin_dep_name')->get();
                return view('dashboard.admin.outcome_products.outcome_products_statistics', compact('outcome_products', 'admin'));

            }
            elseif ($request->country_id != null && $request->whole_product_id == null && $request->wholesale_id ==null &&
                $request->country_product_type == null && $request->start_date && $request->end_date)
            {
                $outcomeProductQuery1 = OutcomeProduct::query();

                $start_date = date('Y-m-d', strtotime($start_date));
                $end_date = date('Y-m-d', strtotime($end_date));
                $outcome_productQuery = $outcomeProductQuery1->whereRaw("date(outcome_products.outcome_product_date) >= '" . $request->start_date . "'
             AND date(outcome_products.outcome_product_date) <= '" . $request->end_date . "'");


                $outcome_products = $outcome_productQuery->select('country_translations.name as country',
                    'whole_product_translations.name AS Product', 'wholesale_translations.Name as admin_dep_name',
                    'outcome_products.country_product_type as country_product_type'
                    , DB::raw('SUM(outcome_products.outcome_product_amount) as product_amount')
                    , 'outcome_products.outcome_product_date AS date')
                    ->join('wholesale_translations', 'outcome_products.wholesale_id', '=', 'wholesale_translations.id')

                    ->join('country_translations', 'outcome_products.country_id', '=', 'country_translations.id')
                    ->join('whole_product_translations', 'outcome_products.whole_product_id', '=', 'whole_product_translations.id')
                    ->where('country_translations.name', $country_name)
                    ->groupBy('country', 'Product', 'country_product_type', 'date', 'admin_dep_name')->get();
                return view('dashboard.admin.outcome_products.outcome_products_statistics', compact('outcome_products', 'admin'));

            }
            elseif ($request->country_id != null && $request->whole_product_id != null && $request->wholesale_id !=null &&
                $request->country_product_type == null && $request->start_date && $request->end_date )
            {
                $outcomeProductQuery1 = OutcomeProduct::query();

                $start_date = date('Y-m-d', strtotime($start_date));
                $end_date = date('Y-m-d', strtotime($end_date));
                $outcome_productQuery = $outcomeProductQuery1->whereRaw("date(outcome_products.outcome_product_date) >= '" . $request->start_date . "'
             AND date(outcome_products.outcome_product_date) <= '" . $request->end_date . "'");


                $outcome_products = $outcome_productQuery->select('country_translations.name as country',
                    'whole_product_translations.name AS Product', 'wholesale_translations.Name as admin_dep_name',
                    'outcome_products.country_product_type as country_product_type'
                    , DB::raw('SUM(outcome_products.outcome_product_amount) as product_amount')
                    , 'outcome_products.outcome_product_date AS date')
                    ->join('wholesale_translations', 'outcome_products.wholesale_id', '=', 'wholesale_translations.id')

                    ->join('country_translations', 'outcome_products.country_id', '=', 'country_translations.id')
                    ->join('whole_product_translations', 'outcome_products.whole_product_id', '=', 'whole_product_translations.id')
                    ->where('country_translations.name', $country_name)
                    ->where('country_product_type', $country_product_type)

                    ->where('wholesale_translations.Name', $wholesale_name)
                    ->groupBy('country', 'Product', 'country_product_type', 'date', 'admin_dep_name')->get();
                return view('dashboard.admin.outcome_products.outcome_products_statistics', compact('outcome_products', 'admin'));

            }
            elseif ($request->country_id != null && $request->whole_product_id == null && $request->wholesale_id ==null &&
                $request->country_product_type != null && $request->start_date && $request->end_date)
            {
                $outcomeProductQuery1 = OutcomeProduct::query();

                $start_date = date('Y-m-d', strtotime($start_date));
                $end_date = date('Y-m-d', strtotime($end_date));
                $outcome_productQuery = $outcomeProductQuery1->whereRaw("date(outcome_products.outcome_product_date) >= '" . $request->start_date . "'
             AND date(outcome_products.outcome_product_date) <= '" . $request->end_date . "'");


                $outcome_products = $outcome_productQuery->select('country_translations.name as country',
                    'whole_product_translations.name AS Product', 'wholesale_translations.Name as admin_dep_name',
                    'outcome_products.country_product_type as country_product_type'
                    , DB::raw('SUM(outcome_products.outcome_product_amount) as product_amount')
                    , 'outcome_products.outcome_product_date AS date')
                    ->join('wholesale_translations', 'outcome_products.wholesale_id', '=', 'wholesale_translations.id')

                    ->join('country_translations', 'outcome_products.country_id', '=', 'country_translations.id')
                    ->join('whole_product_translations', 'outcome_products.whole_product_id', '=', 'whole_product_translations.id')
                    ->where('country_translations.name', $country_name)
                    ->where('outcome_products.country_product_type', $country_product_type)
                    ->groupBy('country', 'Product', 'country_product_type', 'date', 'admin_dep_name')->get();
                return view('dashboard.admin.outcome_products.outcome_products_statistics', compact('outcome_products', 'admin'));

            }

            elseif ($request->country_id != null && $request->whole_product_id != null && $request->wholesale_id ==null &&
                $request->country_product_type == null && $request->start_date && $request->end_date)
            {
                $outcomeProductQuery1 = OutcomeProduct::query();

                $start_date = date('Y-m-d', strtotime($start_date));
                $end_date = date('Y-m-d', strtotime($end_date));
                $outcome_productQuery = $outcomeProductQuery1->whereRaw("date(outcome_products.outcome_product_date) >= '" . $request->start_date . "'
             AND date(outcome_products.outcome_product_date) <= '" . $request->end_date . "'");

                $outcome_products = $outcome_productQuery->select('country_translations.name as country',
                    'whole_product_translations.name AS Product', 'wholesale_translations.Name as admin_dep_name',
                    'outcome_products.country_product_type as country_product_type'
                    , DB::raw('SUM(outcome_products.outcome_product_amount) as product_amount')
                    , 'outcome_products.outcome_product_date AS date')
                    ->join('wholesale_translations', 'outcome_products.wholesale_id', '=', 'wholesale_translations.id')

                    ->join('country_translations', 'outcome_products.country_id', '=', 'country_translations.id')
                    ->join('whole_product_translations', 'outcome_products.whole_product_id', '=', 'whole_product_translations.id')
                    ->where('country_translations.name', $country_name)
                    ->where('whole_product_translations.name', $whole_product_name)
                    ->groupBy('country', 'Product', 'country_product_type', 'date', 'admin_dep_name')->get();
                return view('dashboard.admin.outcome_products.outcome_products_statistics', compact('outcome_products', 'admin'));

            }
            elseif ($request->country_id != null && $request->whole_product_id != null && $request->wholesale_id==null&&
                $request->country_product_type != null && $request->start_date && $request->end_date) {
                $outcomeProductQuery1 = OutcomeProduct::query();

                $start_date = date('Y-m-d', strtotime($start_date));
                $end_date = date('Y-m-d', strtotime($end_date));
                $outcome_productQuery = $outcomeProductQuery1->whereRaw("date(outcome_products.outcome_product_date) >= '" . $request->start_date . "'
             AND date(outcome_products.outcome_product_date) <= '" . $request->end_date . "'");

                $outcome_products = $outcome_productQuery->select('country_translations.name as country',
                    'whole_product_translations.name AS Product', 'wholesale_translations.Name as admin_dep_name',
                    'outcome_products.country_product_type as country_product_type'
                    , DB::raw('SUM(outcome_products.outcome_product_amount) as product_amount')
                    , 'outcome_products.outcome_product_date AS date')
                    ->join('wholesale_translations', 'outcome_products.wholesale_id', '=', 'wholesale_translations.id')

                    ->join('country_translations', 'outcome_products.country_id', '=', 'country_translations.id')
                    ->join('whole_product_translations', 'outcome_products.whole_product_id', '=', 'whole_product_translations.id')
                    ->where('country_translations.name', $country_name)
                    ->where('whole_product_translations.name', $whole_product_name)
                    ->where('outcome_products.country_product_type', $country_product_type)
                    ->groupBy('country', 'Product', 'country_product_type', 'date', 'admin_dep_name')->get();
                return view('dashboard.admin.outcome_products.outcome_products_statistics', compact('outcome_products', 'admin'));

            }
            elseif ($request->country_id == null && $request->whole_product_id == null && $request->wholesale_id==null&&
                $request->country_product_type != null && $request->start_date && $request->end_date) {
                $outcomeProductQuery1 = OutcomeProduct::query();

                $start_date = date('Y-m-d', strtotime($start_date));
                $end_date = date('Y-m-d', strtotime($end_date));
                $outcome_productQuery = $outcomeProductQuery1->whereRaw("date(outcome_products.outcome_product_date) >= '" . $request->start_date . "'
             AND date(outcome_products.outcome_product_date) <= '" . $request->end_date . "'");

                $outcome_products = $outcome_productQuery->select('country_translations.name as country',
                    'whole_product_translations.name AS Product', 'wholesale_translations.Name as admin_dep_name',
                    'outcome_products.country_product_type as country_product_type'
                    , DB::raw('SUM(outcome_products.outcome_product_amount) as product_amount')
                    , 'outcome_products.outcome_product_date AS date')
                    ->join('wholesale_translations', 'outcome_products.wholesale_id', '=', 'wholesale_translations.id')

                    ->join('country_translations', 'outcome_products.country_id', '=', 'country_translations.id')
                    ->join('whole_product_translations', 'outcome_products.whole_product_id', '=', 'whole_product_translations.id')
                    ->where('outcome_products.country_product_type', $country_product_type)
                    ->groupBy('country', 'Product', 'country_product_type', 'date', 'admin_dep_name')->get();
                return view('dashboard.admin.outcome_products.outcome_products_statistics', compact('outcome_products', 'admin'));

            }
            elseif ($request->country_id == null && $request->whole_product_id == null && $request->wholesale_id==null&&
                $request->country_product_type == null && $request->start_date && $request->end_date )
            {

                $outcomeProductQuery1 = OutcomeProduct::query();

                $start_date = date('Y-m-d', strtotime($start_date));
                $end_date = date('Y-m-d', strtotime($end_date));
                $outcome_productQuery = $outcomeProductQuery1->whereRaw("date(outcome_products.outcome_product_date) >= '" . $request->start_date . "'
             AND date(outcome_products.outcome_product_date) <= '" . $request->end_date . "'");

                $outcome_products = $outcome_productQuery->select('country_translations.name as country',
                    'whole_product_translations.name AS Product', 'wholesale_translations.Name as admin_dep_name',
                    'outcome_products.country_product_type as country_product_type'
                    , DB::raw('SUM(outcome_products.outcome_product_amount) as product_amount')
                    , 'outcome_products.outcome_product_date AS date')
                    ->join('wholesale_translations', 'outcome_products.wholesale_id', '=', 'wholesale_translations.id')

                    ->join('country_translations', 'outcome_products.country_id', '=', 'country_translations.id')
                    ->join('whole_product_translations', 'outcome_products.whole_product_id', '=', 'whole_product_translations.id')

                    ->groupBy('country', 'Product', 'country_product_type', 'date', 'admin_dep_name')->get();
                return view('dashboard.admin.outcome_products.outcome_products_statistics', compact('outcome_products', 'admin'));

            }
            elseif ($request->country_id == null && $request->whole_product_id != null && $request->wholesale_id!=null&&
                $request->country_product_type == null && $request->start_date && $request->end_date) {

                $outcomeProductQuery1 = OutcomeProduct::query();

                $start_date = date('Y-m-d', strtotime($start_date));
                $end_date = date('Y-m-d', strtotime($end_date));
                $outcome_productQuery = $outcomeProductQuery1->whereRaw("date(outcome_products.outcome_product_date) >= '" . $request->start_date . "'
             AND date(outcome_products.outcome_product_date) <= '" . $request->end_date . "'");

                $outcome_products = $outcome_productQuery->select('country_translations.name as country',
                    'whole_product_translations.name AS Product', 'wholesale_translations.Name as admin_dep_name',
                    'outcome_products.country_product_type as country_product_type'
                    , DB::raw('SUM(outcome_products.outcome_product_amount) as product_amount')
                    , 'outcome_products.outcome_product_date AS date')
                    ->join('wholesale_translations', 'outcome_products.wholesale_id', '=', 'wholesale_translations.id')

                    ->join('country_translations', 'outcome_products.country_id', '=', 'country_translations.id')
                    ->join('whole_product_translations', 'outcome_products.whole_product_id', '=', 'whole_product_translations.id')
                    ->where('whole_product_translations.name', $whole_product_name)
                    ->where('wholesale_translations.Name', $wholesale_name)
                    ->groupBy('country', 'Product', 'country_product_type', 'date', 'admin_dep_name')->get();
                return view('dashboard.admin.outcome_products.outcome_products_statistics', compact('outcome_products', 'admin'));

            }

            elseif ($request->country_id != null && $request->whole_product_id != null && $request->wholesale_id!=null &&
                $request->country_product_type != null ) {

                $outcomeQuery = OutcomeProduct::query();

                $outcome_products = $outcomeQuery->select('country_translations.name as country',
                    'whole_product_translations.name AS Product', 'wholesale_translations.Name as admin_dep_name',
                    'outcome_products.country_product_type as country_product_type'
                    , DB::raw('SUM(outcome_products.outcome_product_amount) as product_amount')

                    , 'outcome_products.outcome_product_date AS date')
                    ->join('wholesale_translations', 'outcome_products.wholesale_id', '=', 'wholesale_translations.id')

                    ->join('country_translations', 'outcome_products.country_id', '=', 'country_translations.id')
                    ->join('whole_product_translations', 'outcome_products.whole_product_id', '=', 'whole_product_translations.id')
                    ->where('whole_product_translations.name', $whole_product_name)
                    ->where('wholesale_translations.Name', $wholesale_name)
                    ->where('country_translations.name', $country_name)
                    ->where('country_product_type', $country_product_type)
                    ->groupBy('country', 'Product', 'country_product_type', 'date', 'admin_dep_name')->get();
                return view('dashboard.admin.outcome_products.outcome_products_statistics', compact('outcome_products', 'admin'));

            }
            elseif ($request->country_id == null && $request->whole_product_id != null && $request->wholesale_id != null &&
                $request->country_product_type != null && $request->start_date == null && $request->end_date == null) {

                $outcome_products = OutcomeProduct::select('country_translations.name as country',
                    'whole_product_translations.name AS Product', 'wholesale_translations.Name as admin_dep_name',
                    'outcome_products.country_product_type as country_product_type'
                    , DB::raw('SUM(outcome_products.outcome_product_amount) as product_amount')

                    , 'outcome_products.outcome_product_date AS date')
                    ->join('wholesale_translations', 'outcome_products.wholesale_id', '=', 'wholesale_translations.id')

                    ->join('country_translations', 'outcome_products.country_id', '=', 'country_translations.id')
                    ->join('whole_product_translations', 'outcome_products.whole_product_id', '=', 'whole_product_translations.id')
                    ->where('whole_product_translations.name', $whole_product_name)
                    ->where('wholesale_translations.Name', $wholesale_name)
                    ->where('country_product_type', $country_product_type)
                    ->groupBy('country', 'Product', 'country_product_type', 'date', 'admin_dep_name')->get();
                return view('dashboard.admin.outcome_products.outcome_products_statistics', compact('outcome_products', 'admin'));
            }
            elseif ($request->country_id != null && $request->whole_product_id != null && $request->wholesale_id != null &&
                $request->country_product_type == null && $request->start_date == null && $request->end_date == null) {

                $outcome_products = OutcomeProduct::select('country_translations.name as country',
                    'whole_product_translations.name AS Product', 'wholesale_translations.Name as admin_dep_name',
                    'outcome_products.country_product_type as country_product_type'
                    , DB::raw('SUM(outcome_products.outcome_product_amount) as product_amount')

                    , 'outcome_products.outcome_product_date AS date')
                    ->join('wholesale_translations', 'outcome_products.wholesale_id', '=', 'wholesale_translations.id')

                    ->join('country_translations', 'outcome_products.country_id', '=', 'country_translations.id')
                    ->join('whole_product_translations', 'outcome_products.whole_product_id', '=', 'whole_product_translations.id')
                    ->where('whole_product_translations.name', $whole_product_name)
                    ->where('wholesale_translations.Name', $wholesale_name)
                    ->where('country_translations.name', $country_name)
                    ->groupBy('country', 'Product', 'country_product_type', 'date', 'admin_dep_name')->get();
                return view('dashboard.admin.outcome_products.outcome_products_statistics', compact('outcome_products', 'admin'));
            }
            elseif ($request->country_id != null && $request->whole_product_id == null && $request->wholesale_id == null &&
                $request->country_product_type == null && $request->start_date == null && $request->end_date == null) {
                $outcome_products = OutcomeProduct::select('country_translations.name as country',
                    'whole_product_translations.name AS Product', 'wholesale_translations.Name as admin_dep_name',
                    'outcome_products.country_product_type as country_product_type'
                    , DB::raw('SUM(outcome_products.outcome_product_amount) as product_amount')

                    , 'outcome_products.outcome_product_date AS date')
                    ->join('wholesale_translations', 'outcome_products.wholesale_id', '=', 'wholesale_translations.id')

                    ->join('country_translations', 'outcome_products.country_id', '=', 'country_translations.id')
                    ->join('whole_product_translations', 'outcome_products.whole_product_id', '=', 'whole_product_translations.id')
                    ->where('country_translations.name', $country_name)

                    ->groupBy('country', 'Product', 'country_product_type', 'date', 'admin_dep_name')->get();
                return view('dashboard.admin.outcome_products.outcome_products_statistics', compact('outcome_products', 'admin'));

            }
            elseif ($request->country_id != null && $request->whole_product_id == null && $request->wholesale_id != null &&
                $request->country_product_type == null && $request->start_date == null && $request->end_date == null) {

                $outcome_products = OutcomeProduct::select('country_translations.name as country',
                    'whole_product_translations.name AS Product', 'wholesale_translations.Name as admin_dep_name',
                    'outcome_products.country_product_type as country_product_type'
                    , DB::raw('SUM(outcome_products.outcome_product_amount) as product_amount')

                    , 'outcome_products.outcome_product_date AS date')
                    ->join('wholesale_translations', 'outcome_products.wholesale_id', '=', 'wholesale_translations.id')

                    ->join('country_translations', 'outcome_products.country_id', '=', 'country_translations.id')
                    ->join('whole_product_translations', 'outcome_products.whole_product_id', '=', 'whole_product_translations.id')
                    ->where('country_translations.name', $country_name)
                    ->where('wholesale_translations.Name', $wholesale_name)

                    ->groupBy('country', 'Product', 'country_product_type', 'date', 'admin_dep_name')->get();
                return view('dashboard.admin.outcome_products.outcome_products_statistics', compact('outcome_products', 'admin'));

            }
            elseif ($request->country_id != null && $request->whole_product_id != null && $request->wholesale_id == null &&
                $request->country_product_type == null && $request->start_date == null && $request->end_date == null) {

                $outcome_products = OutcomeProduct::select('country_translations.name as country',
                    'whole_product_translations.name AS Product', 'wholesale_translations.Name as admin_dep_name',
                    'outcome_products.country_product_type as country_product_type'
                    , DB::raw('SUM(outcome_products.outcome_product_amount) as product_amount')

                    , 'outcome_products.outcome_product_date AS date')
                    ->join('wholesale_translations', 'outcome_products.wholesale_id', '=', 'wholesale_translations.id')

                    ->join('country_translations', 'outcome_products.country_id', '=', 'country_translations.id')
                    ->join('whole_product_translations', 'outcome_products.whole_product_id', '=', 'whole_product_translations.id')
                    ->where('country_translations.name', $country_name)
                    ->where('whole_product_translations.name', $whole_product_name)

                    ->groupBy('country', 'Product', 'country_product_type', 'date', 'admin_dep_name')->get();
                return view('dashboard.admin.outcome_products.outcome_products_statistics', compact('outcome_products', 'admin'));

            }
            elseif ($request->country_id != null && $request->whole_product_id != null && $request->wholesale_id == null &&
                $request->country_product_type != null && $request->start_date == null && $request->end_date == null) {

                $outcome_products = OutcomeProduct::select('country_translations.name as country',
                    'whole_product_translations.name AS Product', 'wholesale_translations.Name as admin_dep_name',
                    'outcome_products.country_product_type as country_product_type'
                    , DB::raw('SUM(outcome_products.outcome_product_amount) as product_amount')

                    , 'outcome_products.outcome_product_date AS date')
                    ->join('wholesale_translations', 'outcome_products.wholesale_id', '=', 'wholesale_translations.id')

                    ->join('country_translations', 'outcome_products.country_id', '=', 'country_translations.id')
                    ->join('whole_product_translations', 'outcome_products.whole_product_id', '=', 'whole_product_translations.id')
                    ->where('country_translations.name', $country_name)
                    ->where('outcome_products.country_product_type', $country_product_type)
                    ->where('whole_product_translations.name', $whole_product_name)

                    ->groupBy('country', 'Product', 'country_product_type', 'date', 'admin_dep_name')->get();
                return view('dashboard.admin.outcome_products.outcome_products_statistics', compact('outcome_products', 'admin'));

            }
            elseif ($request->country_id != null && $request->whole_product_id == null && $request->wholesale_id == null &&
                $request->country_product_type != null && $request->start_date == null && $request->end_date == null) {

                $outcome_products = OutcomeProduct::select('country_translations.name as country',
                    'whole_product_translations.name AS Product', 'wholesale_translations.Name as admin_dep_name',
                    'outcome_products.country_product_type as country_product_type'
                    , DB::raw('SUM(outcome_products.outcome_product_amount) as product_amount')

                    , 'outcome_products.outcome_product_date AS date')
                    ->join('wholesale_translations', 'outcome_products.wholesale_id', '=', 'wholesale_translations.id')

                    ->join('country_translations', 'outcome_products.country_id', '=', 'country_translations.id')
                    ->join('whole_product_translations', 'outcome_products.whole_product_id', '=', 'whole_product_translations.id')
                    ->where('country_translations.name', $country_name)
                    ->where('outcome_products.country_product_type', $country_product_type)

                    ->groupBy('country', 'Product', 'country_product_type', 'date', 'admin_dep_name')->get();
                return view('dashboard.admin.outcome_products.outcome_products_statistics', compact('outcome_products', 'admin'));

            }
            elseif ($request->country_id == null && $request->whole_product_id == null && $request->wholesale_id==null&&
                $request->country_product_type != null && $request->start_date == null && $request->end_date == null) {


                $outcome_products = OutcomeProduct::select('country_translations.name as country',
                    'whole_product_translations.name AS Product', 'wholesale_translations.Name as admin_dep_name',
                    'outcome_products.country_product_type as country_product_type'
                    , DB::raw('SUM(outcome_products.outcome_product_amount) as product_amount')

                    , 'outcome_products.outcome_product_date AS date')
                    ->join('wholesale_translations', 'outcome_products.wholesale_id', '=', 'wholesale_translations.id')

                    ->join('country_translations', 'outcome_products.country_id', '=', 'country_translations.id')
                    ->join('whole_product_translations', 'outcome_products.whole_product_id', '=', 'whole_product_translations.id')
                    ->where('country_product_type', $country_product_type)
                    ->groupBy('country', 'Product', 'country_product_type', 'date', 'admin_dep_name')->get();
                return view('dashboard.admin.outcome_products.outcome_products_statistics', compact('outcome_products', 'admin'));

            }
            elseif ($request->country_id == null && $request->whole_product_id == null && $request->wholesale_id==null&&
                $request->country_product_type == null && $request->start_date == null && $request->end_date == null) {


                $outcome_products = OutcomeProduct::select('country_translations.name as country',
                    'whole_product_translations.name AS Product', 'wholesale_translations.Name as admin_dep_name',
                    'outcome_products.country_product_type as country_product_type'
                    , DB::raw('SUM(outcome_products.outcome_product_amount) as product_amount')

                    , 'outcome_products.outcome_product_date AS date')
                    ->join('wholesale_translations', 'outcome_products.wholesale_id', '=', 'wholesale_translations.id')

                    ->join('country_translations', 'outcome_products.country_id', '=', 'country_translations.id')
                    ->join('whole_product_translations', 'outcome_products.whole_product_id', '=', 'whole_product_translations.id')
                    ->groupBy('country', 'Product', 'country_product_type', 'date', 'admin_dep_name')->get();
                return view('dashboard.admin.outcome_products.outcome_products_statistics', compact('outcome_products', 'admin'));

            }
            elseif ($request->country_id == null && $request->whole_product_id != null && $request->wholesale_id!=null&&
                $request->country_product_type == null && $request->start_date == null && $request->end_date == null) {


                $outcome_products = OutcomeProduct::select('country_translations.name as country',
                    'whole_product_translations.name AS Product', 'wholesale_translations.Name as admin_dep_name',
                    'outcome_products.country_product_type as country_product_type'
                    , DB::raw('SUM(outcome_products.outcome_product_amount) as product_amount')

                    , 'outcome_products.outcome_product_date AS date')
                    ->join('wholesale_translations', 'outcome_products.wholesale_id', '=', 'wholesale_translations.id')

                    ->join('country_translations', 'outcome_products.country_id', '=', 'country_translations.id')
                    ->join('whole_product_translations', 'outcome_products.whole_product_id', '=', 'whole_product_translations.id')
                    ->where('whole_product_translations.name', $whole_product_name)
                    ->where('wholesale_translations.Name', $wholesale_name)
                    ->groupBy('country', 'Product', 'country_product_type', 'date', 'admin_dep_name')->get();
                return view('dashboard.admin.outcome_products.outcome_products_statistics', compact('outcome_products', 'admin'));

            }
        }
        elseif ($admin->type =='employee'){

            if ($request->country_id != null && $request->whole_product_id != null &&
                $request->country_product_type != null && $request->start_date && $request->end_date) {

                $outcomeProductQuery1 = OutcomeProduct::query();

                $start_date = date('Y-m-d', strtotime($start_date));
                $end_date = date('Y-m-d', strtotime($end_date));
                $outcome_productQuery = $outcomeProductQuery1->whereRaw("date(outcome_products.outcome_product_date) >= 
                '" . $request->start_date . "'
             AND date(outcome_products.outcome_product_date) <= '" . $request->end_date . "'");
                $outcome_products = $outcome_productQuery->select('country_translations.name as country',
                    'whole_product_translations.name AS Product', 'wholesale_translations.Name as admin_dep_name',
                    'outcome_products.country_product_type as country_product_type'
                    , DB::raw('SUM(outcome_products.outcome_product_amount) as product_amount')

                    , 'outcome_products.outcome_product_date AS date')
                    ->join('wholesale_translations', 'outcome_products.wholesale_id', '=', 'wholesale_translations.id')

                    ->join('country_translations', 'outcome_products.country_id',
                        '=', 'country_translations.id')
                    ->join('whole_product_translations', 'outcome_products.whole_product_id',
                        '=', 'whole_product_translations.id')
                    ->where('whole_product_translations.name', $whole_product_name)
                    ->where('outcome_products.admin_id', $admin->id)
                    ->where('country_translations.name', $country_name)
                    ->where('country_product_type', $country_product_type)
                    ->groupBy('country', 'Product', 'country_product_type', 'date', 'admin_dep_name')->get();
                return view('dashboard.admin.outcome_products.outcome_products_statistics',
                    compact('outcome_products', 'admin'));

            }
            elseif ($request->countrry_id == null && $request->whole_product_id != null &&
                $request->country_product_type != null && $request->start_date && $request->end_date) {
                $outcomeProductQuery1 = OutcomeProduct::query();

                $start_date = date('Y-m-d', strtotime($start_date));
                $end_date = date('Y-m-d', strtotime($end_date));
                $outcome_productQuery = $outcomeProductQuery1->whereRaw("date(outcome_products.outcome_product_date) >= 
                '" . $request->start_date . "'
             AND date(outcome_products.outcome_product_date) <= '" . $request->end_date . "'");
                $outcome_products = $outcome_productQuery->select('country_translations.name as country',
                    'whole_product_translations.name AS Product', 'wholesale_translations.Name as admin_dep_name',
                    'outcome_products.country_product_type as country_product_type'
                    , DB::raw('SUM(outcome_products.outcome_product_amount) as product_amount')

                    , 'outcome_products.outcome_product_date AS date')
                    ->join('wholesale_translations', 'outcome_products.wholesale_id', '=', 'wholesale_translations.id')

                    ->join('country_translations', 'outcome_products.country_id',
                        '=', 'country_translations.id')
                    ->join('whole_product_translations', 'outcome_products.whole_product_id',
                        '=', 'whole_product_translations.id')
                    ->where('whole_product_translations.name', $whole_product_name)
                    ->where('country_product_type', $country_product_type)
                    ->where('outcome_products.admin_id', $admin->id)

                    ->groupBy('country', 'Product', 'country_product_type', 'date', 'admin_dep_name')->get();
                return view('dashboard.admin.outcome_products.outcome_products_statistics',
                    compact('outcome_products', 'admin'));

            }
            elseif ($request->countrry_id == null && $request->whole_product_id == null &&
                $request->country_product_type != null && $request->start_date && $request->end_date) {
                $outcomeProductQuery1 = OutcomeProduct::query();

                $start_date = date('Y-m-d', strtotime($start_date));
                $end_date = date('Y-m-d', strtotime($end_date));
                $outcome_productQuery = $outcomeProductQuery1->whereRaw("date(outcome_products.outcome_product_date) >= 
                '" . $request->start_date . "'
             AND date(outcome_products.outcome_product_date) <= '" . $request->end_date . "'");
                $outcome_products = $outcome_productQuery->select('country_translations.name as country',
                    'whole_product_translations.name AS Product', 'wholesale_translations.Name as admin_dep_name',
                    'outcome_products.country_product_type as country_product_type'
                    , DB::raw('SUM(outcome_products.outcome_product_amount) as product_amount')

                    , 'outcome_products.outcome_product_date AS date')
                    ->join('wholesale_translations', 'outcome_products.wholesale_id', '=', 'wholesale_translations.id')

                    ->join('country_translations', 'outcome_products.country_id',
                        '=', 'country_translations.id')
                    ->join('whole_product_translations', 'outcome_products.whole_product_id',
                        '=', 'whole_product_translations.id')
                    ->where('country_product_type', $country_product_type)
                    ->where('outcome_products.admin_id', $admin->id)

                    ->groupBy('country', 'Product', 'country_product_type', 'date', 'admin_dep_name')->get();
                return view('dashboard.admin.outcome_products.outcome_products_statistics',
                    compact('outcome_products', 'admin'));
            }
            elseif ($request->countrry_id == null && $request->whole_product_id == null &&
                $request->country_product_type == null && $request->start_date && $request->end_date) {

                $outcomeProductQuery1 = OutcomeProduct::query();

                $start_date = date('Y-m-d', strtotime($start_date));
                $end_date = date('Y-m-d', strtotime($end_date));
                $outcome_productQuery = $outcomeProductQuery1->whereRaw("date(outcome_products.outcome_product_date) >= 
                '" . $request->start_date . "'
             AND date(outcome_products.outcome_product_date) <= '" . $request->end_date . "'");
                $outcome_products = $outcome_productQuery->select('country_translations.name as country',
                    'whole_product_translations.name AS Product', 'wholesale_translations.Name as admin_dep_name',
                    'outcome_products.country_product_type as country_product_type'
                    , DB::raw('SUM(outcome_products.outcome_product_amount) as product_amount')

                    , 'outcome_products.outcome_product_date AS date')
                    ->join('wholesale_translations', 'outcome_products.wholesale_id', '=', 'wholesale_translations.id')

                    ->join('country_translations', 'outcome_products.country_id',
                        '=', 'country_translations.id')
                    ->join('whole_product_translations', 'outcome_products.whole_product_id',
                        '=', 'whole_product_translations.id')
                    ->where('outcome_products.admin_id', $admin->id)

                    ->groupBy('country', 'Product', 'country_product_type', 'date', 'admin_dep_name')->get();
                return view('dashboard.admin.outcome_products.outcome_products_statistics',
                    compact('outcome_products', 'admin'));
            }
            elseif ($request->countrry_id == null && $request->whole_product_id != null &&
                $request->country_product_type == null && $request->start_date && $request->end_date) {

                $outcomeProductQuery1 = OutcomeProduct::query();

                $start_date = date('Y-m-d', strtotime($start_date));
                $end_date = date('Y-m-d', strtotime($end_date));
                $outcome_productQuery = $outcomeProductQuery1->whereRaw("date(outcome_products.outcome_product_date) >= 
                '" . $request->start_date . "'
             AND date(outcome_products.outcome_product_date) <= '" . $request->end_date . "'");
                $outcome_products = $outcome_productQuery->select('country_translations.name as country',
                    'whole_product_translations.name AS Product', 'wholesale_translations.Name as admin_dep_name',
                    'outcome_products.country_product_type as country_product_type'
                    , DB::raw('SUM(outcome_products.outcome_product_amount) as product_amount')

                    , 'outcome_products.outcome_product_date AS date')
                    ->join('wholesale_translations', 'outcome_products.wholesale_id', '=', 'wholesale_translations.id')

                    ->join('country_translations', 'outcome_products.country_id','=', 'country_translations.id')
                    ->join('whole_product_translations', 'outcome_products.whole_product_id',
                        '=', 'whole_product_translations.id')
                    ->where('whole_product_translations.name', $whole_product_name)
                    ->where('outcome_products.admin_id', $admin->id)

                    ->groupBy('country', 'Product', 'country_product_type', 'date', 'admin_dep_name')->get();
                return view('dashboard.admin.outcome_products.outcome_products_statistics',
                    compact('outcome_products', 'admin'));
            }
            elseif ($request->countrry_id == null && $request->whole_product_id != null &&
                $request->country_product_type == null && $request->start_date && $request->end_date) {

                $outcomeProductQuery1 = OutcomeProduct::query();

                $start_date = date('Y-m-d', strtotime($start_date));
                $end_date = date('Y-m-d', strtotime($end_date));
                $outcome_productQuery = $outcomeProductQuery1->whereRaw("date(outcome_products.outcome_product_date) >= 
                '" . $request->start_date . "'
             AND date(outcome_products.outcome_product_date) <= '" . $request->end_date . "'");
                $outcome_products = $outcome_productQuery->select('country_translations.name as country',
                    'whole_product_translations.name AS Product', 'wholesale_translations.Name as admin_dep_name',
                    'outcome_products.country_product_type as country_product_type'
                    , DB::raw('SUM(outcome_products.outcome_product_amount) as product_amount')

                    , 'outcome_products.outcome_product_date AS date')
                    ->join('wholesale_translations', 'outcome_products.wholesale_id', '=', 'wholesale_translations.id')

                    ->join('country_translations', 'outcome_products.country_id',
                        '=', 'country_translations.id')
                    ->join('whole_product_translations', 'outcome_products.whole_product_id',
                        '=', 'whole_product_translations.id')
                    ->where('whole_product_translations.name', $whole_product_name)
                    ->where('outcome_products.admin_id', $admin->id)

                    ->groupBy('country', 'Product', 'country_product_type', 'date', 'admin_dep_name')->get();
                return view('dashboard.admin.outcome_products.outcome_products_statistics', compact('outcome_products', 'admin'));

            }
            elseif ($request->countrry_id != null && $request->whole_product_id != null &&
                $request->country_product_type != null && $request->start_date == null && $request->end_date == null) {


                $outcome_products = OutcomeProduct::select('country_translations.name as country',
                    'whole_product_translations.name AS Product', 'wholesale_translations.Name as admin_dep_name',
                    'outcome_products.country_product_type as country_product_type'
                    , DB::raw('SUM(outcome_products.outcome_product_amount) as product_amount')

                    , 'outcome_products.outcome_product_date AS date')
                    ->join('wholesale_translations', 'outcome_products.wholesale_id', '=', 'wholesale_translations.id')

                    ->join('country_translations', 'outcome_products.country_id', '=', 'country_translations.id')
                    ->join('whole_product_translations', 'outcome_products.whole_product_id', '=', 'whole_product_translations.id')
                    ->where('whole_product_translations.name', $whole_product_name)
                    ->where('country_translations.name', $country_name)
                    ->where('outcome_products.admin_id', $admin->id)

                    ->where('country_product_type', $country_product_type)
                    ->groupBy('country', 'Product', 'country_product_type', 'date', 'admin_dep_name')->get();
                return view('dashboard.admin.outcome_products.outcome_products_statistics', compact('outcome_products', 'admin'));

            }
            elseif ($request->countrry_id == null && $request->whole_product_id != null &&
                $request->country_product_type != null && $request->start_date == null && $request->end_date == null) {

                $outcome_products = OutcomeProduct::select('country_translations.name as country',
                    'whole_product_translations.name AS Product', 'wholesale_translations.Name as admin_dep_name',
                    'outcome_products.country_product_type as country_product_type'
                    , DB::raw('SUM(outcome_products.outcome_product_amount) as product_amount')

                    , 'outcome_products.outcome_product_date AS date')
                    ->join('wholesale_translations', 'outcome_products.wholesale_id', '=', 'wholesale_translations.id')

                    ->join('country_translations', 'outcome_products.country_id', '=', 'country_translations.id')
                    ->join('whole_product_translations', 'outcome_products.whole_product_id', '=', 'whole_product_translations.id')
                    ->where('whole_product_translations.name', $whole_product_name)
                    ->where('country_product_type', $country_product_type)
                    ->where('outcome_products.admin_id', $admin->id)

                    ->groupBy('country', 'Product', 'country_product_type', 'date', 'admin_dep_name')->get();
                return view('dashboard.admin.outcome_products.outcome_products_statistics', compact('outcome_products', 'admin'));

            }
            elseif ($request->countrry_id == null && $request->whole_product_id == null &&
                $request->country_product_type != null && $request->start_date == null && $request->end_date == null) {


                $outcome_products = OutcomeProduct::select('country_translations.name as country',
                    'whole_product_translations.name AS Product', 'wholesale_translations.Name as admin_dep_name',
                    'outcome_products.country_product_type as country_product_type'
                    , DB::raw('SUM(outcome_products.outcome_product_amount) as product_amount')

                    , 'outcome_products.outcome_product_date AS date')
                    ->join('wholesale_translations', 'outcome_products.wholesale_id', '=', 'wholesale_translations.id')

                    ->join('country_translations', 'outcome_products.country_id', '=', 'country_translations.id')
                    ->join('whole_product_translations', 'outcome_products.whole_product_id', '=', 'whole_product_translations.id')
                    ->where('whole_product_translations.name', $whole_product_name)
                    ->where('country_product_type', $country_product_type)
                    ->where('outcome_products.admin_id', $admin->id)

                    ->groupBy('country', 'Product', 'country_product_type', 'date', 'admin_dep_name')->get();
                return view('dashboard.admin.outcome_products.outcome_products_statistics', compact('outcome_products', 'admin'));

            }
            elseif ($request->countrry_id == null && $request->whole_product_id == null &&
                $request->country_product_type == null && $request->start_date == null && $request->end_date == null) {



                $outcome_products = OutcomeProduct::select('country_translations.name as country',
                    'whole_product_translations.name AS Product', 'wholesale_translations.Name as admin_dep_name',
                    'outcome_products.country_product_type as country_product_type'
                    , DB::raw('SUM(outcome_products.outcome_product_amount) as product_amount')

                    , 'outcome_products.outcome_product_date AS date')
                    ->join('wholesale_translations', 'outcome_products.wholesale_id', '=', 'wholesale_translations.id')

                    ->join('country_translations', 'outcome_products.country_id', '=', 'country_translations.id')
                    ->join('whole_product_translations', 'outcome_products.whole_product_id', '=', 'whole_product_translations.id')
                    ->where('outcome_products.admin_id', $admin->id)

                    ->groupBy('country', 'Product', 'country_product_type', 'date', 'admin_dep_name')->get();
                return view('dashboard.admin.outcome_products.outcome_products_statistics', compact('outcome_products', 'admin'));

            }
            elseif ($request->countrry_id == null && $request->whole_product_id != null &&
                $request->country_product_type == null && $request->start_date == null && $request->end_date == null) {


                $outcome_products = OutcomeProduct::select('country_translations.name as country',
                    'whole_product_translations.name AS Product', 'wholesale_translations.Name as admin_dep_name',
                    'outcome_products.country_product_type as country_product_type'
                    , DB::raw('SUM(outcome_products.outcome_product_amount) as product_amount')

                    , 'outcome_products.outcome_product_date AS date')
                    ->join('wholesale_translations', 'outcome_products.wholesale_id', '=', 'wholesale_translations.id')

                    ->join('country_translations', 'outcome_products.country_id', '=', 'country_translations.id')
                    ->join('whole_product_translations', 'outcome_products.whole_product_id', '=', 'whole_product_translations.id')
                    ->where('whole_product_translations.name', $whole_product_name)
                    ->where('outcome_products.admin_id', $admin->id)

                    ->groupBy('country', 'Product', 'country_product_type', 'date', 'admin_dep_name')->get();
                return view('dashboard.admin.outcome_products.outcome_products_statistics', compact('outcome_products', 'admin'));

            }
        }
    }


}