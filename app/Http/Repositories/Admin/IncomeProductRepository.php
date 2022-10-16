<?php

namespace App\Http\Repositories\Admin;

use App\Http\Interfaces\Admin\IncomeProductInterface;
use App\Models\IncomeProduct;
use App\Models\Admin;
use App\Models\Country;
use App\Models\CountryTranslation;

use App\Models\Province;
use App\Models\Area;
use App\Models\WholeProduct;
use App\Models\Currency;

use App\Models\State;
use App\Models\Unit;

use App\Models\AdminDepartment;
use App\Models\WholeProductTranslation;
use App\Models\WholesaleTranslation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use App\Traits\UploadT;
use Illuminate\Http\Request;
use Auth;
use Yajra\DataTables\DataTables;

class IncomeProductRepository implements IncomeProductInterface
{
    public function index()
    {
        $adminID = Auth::user()->id;
        $admin = Admin::findorfail($adminID);
        if ($admin->area == Null && $admin->state == null) {
            toastr()->error(__('Admin/services.index-wrong'));

            return redirect()->back();
        } else {
            $department_id = $admin->adminDepartment->id;
            $adminDepartment = AdminDepartment::findorfail($department_id);
            $dep_name = $adminDepartment->name;
            return view('dashboard.admin.income_products.index', compact('admin', 'dep_name'));
        }

    }

    public function data()
    {
        $adminID = Auth::user()->id;
        $admin = Admin::findorfail($adminID);
        if ($admin->type == 'employee') {
            $incomes = IncomeProduct::with('country', 'whole_product', 'admin', 'unit', 'currency')
                ->where('admin_id', $admin->id)->get();
        } else {
            $incomes = IncomeProduct::with('country', 'whole_product', 'admin', 'unit', 'currency')->get();

        }
        return DataTables::of($incomes)
            ->addColumn('record_select', 'dashboard.admin.income_products.data_table.record_select')
            ->addIndexColumn()
            ->editColumn('created_at', function (IncomeProduct $income) {
                return $income->created_at->diffforhumans();
            })
//            ->addColumn('admin', function (IncomeProduct $income) {
//                return $income->admin->firstname;
//            })
            ->addColumn('country', function (IncomeProduct $income) {
                return $income->country->name;
            })
            ->addColumn('wholesale', function (IncomeProduct $income) {
                return $income->wholesale->Name;
            })
            ->addColumn('product', function (IncomeProduct $income) {
                return $income->whole_product->name;
            })
            ->editColumn('country_product_type', function (IncomeProduct $income) {
                return view('dashboard.admin.income_products.data_table.country_product_type', compact('income'));


            })
            ->addColumn('area', function (IncomeProduct $income) {
                if (!empty($income->area)) {
                    return $income->area->name;
                } else {
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

    public function create()
    {
        $adminID = Auth::user()->id;
        $admin = Admin::findorfail($adminID);
        $department_id = $admin->adminDepartment->id;
        $admin_dep_name = $admin->adminDepartment->name;
        $countries = Country::all();
        $whole_products = WholeProduct::all();
        $currencies = Currency::all();
        $units = Unit::all();


        return view('dashboard.admin.income_products.create',
            compact('admin', 'whole_products', 'countries', 'admin_dep_name', 'units', 'currencies', 'adminID'));
    }

    public function store($request)
    {
        try {
            $requestData = $request->validated();
//            $income_product = new IncomeProduct();
            $income_product = IncomeProduct::create([
                'admin_id' => $requestData['admin_id'],
                'country_id' => $requestData['country_id'],
                'country_product_type' => $requestData['country_product_type'],
                'whole_product_id' => $requestData['whole_product_id'],
                'unit_id' => $requestData['unit_id'],
                'currency_id' => $requestData['currency_id'],
                'wholesale_id' => $requestData['wholesale_id'],
                'income_product_amount' => $requestData['income_product_amount'],
                'income_product_price' => $requestData['income_product_price'],
                'income_product_date' => $requestData['income_product_date'],
            ]);


            toastr()->success(__('Admin/site.added_successfully'));
            return redirect()->route('IncomeProducts.index');


        } catch (\Exception $e) {
            toastr()->error(__('Admin/attributes.add_wrong'));
//            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
            return redirect()->back();
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $outID = Crypt::decrypt($id);
        $countries = Country::all();
        $whole_products = WholeProduct::all();

        $income_product = IncomeProduct::findorfail($outID);
        $adminID = Auth::user()->id;
        $admin = Admin::findorfail($adminID);
        $admin_dep_name = $admin->adminDepartment->name;

        $units = Unit::all();
        $currencies = Currency::all();

        return view('dashboard.admin.income_products.edit',
            compact('admin_dep_name', 'countries', 'units', 'adminID',
                'income_product', 'whole_products', 'currencies', 'admin'));
    }


    public function update($request, $id)
    {
        try {
            $InID = Crypt::decrypt($id);
            $requestData = $request->validated();
            $income_product = IncomeProduct::findorfail($InID);
            $income_product->admin_id = $requestData['admin_id'];


            $income_product->country_id = $requestData['country_id'];
            $income_product->unit_id = $requestData['unit_id'];
            $income_product->country_product_type = $requestData['country_product_type'];


            $income_product->wholesale_id = $requestData['wholesale_id'];
            $income_product->income_product_price = $requestData['income_product_price'];
            $income_product->income_product_date = $requestData['income_product_date'];


            $income_product->update($requestData);

            toastr()->success(__('Admin/site.updated_successfully'));
            return redirect()->route('IncomeProducts.index');


        } catch (\Exception $e) {
            toastr()->error(__('Admin/attributes.edit_wrong'));
            return redirect()->back();
        }
    }

    public function destroy($id)
    {
        try {
            $InID = Crypt::decrypt($id);
            $income_product = IncomeProduct::findorfail($InID);


            $income_product->delete();
            toastr()->success(__('Admin/site.deleted_successfully'));
            return redirect()->route('IncomeProducts.index');
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
        } catch (\Exception $e) {
            DB::rollBack();
            toastr()->error(__('Admin/attributes.delete_wrong'));

            return redirect()->back();

        }


    }// end of bulkDelete


    public function index_income_products()
    {

        $adminID = Auth::user()->id;
        $admin = Admin::findorfail($adminID);

        return view('dashboard.admin.income_products.income_products_statistics', compact('admin'));
    }

    public function income_product_statistics($request)
    {
        $validated = $request->validate([

                'start_date' => 'sometimes|nullable|date',
                'end_date' => 'sometimes|nullable|date|after_or_equal:start_date',
                'country_id' => 'sometimes|nullable|exists:countries,id',
                'whole_product_id' => 'sometimes|nullable|exists:whole_products,id',
                'country_product_type' => 'sometimes|nullable|in:local,iraq,imported',
                'wholesale_id' => 'sometimes|nullable|exists:wholesales,id'
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

//        if (!empty($request->country_id)) {
//            $country_name = CountryTranslation::where('country_id', '=', $request->country_id)->pluck('name');
//
//        }
//        if (!empty($request->whole_product_id)) {
//            $whole_product_name = WholeProductTranslation::where('whole_product_id', '=', $request->whole_product_id)->pluck('name');
//        }
//
//        if (!empty($request->wholesale_id)) {
//            $wholesale_name = WholesaleTranslation::where('wholesale_id', '=', $request->wholesale_id)->pluck('Name');
//
//        }


        $start_date = (!empty($_GET["start_date"])) ? ($_GET["start_date"]) : ('');
        $end_date = (!empty($_GET["end_date"])) ? ($_GET["end_date"]) : ('');


        $latests = \DB::table('farmer_crops')->orderBy('date', 'desc')->first();
        $oldest = \DB::table('farmer_crops')->orderBy('date', 'asc')->first();

        if ($admin->type == 'admin' || $admin->type =='admin_area') {
            if ($request->country_id != null && $request->whole_product_id != null && $request->wholesale_id !=null &&
                $request->country_product_type != null && $request->start_date && $request->end_date)
            {
                $IncomeProductQuery1 = IncomeProduct::query();

                $start_date = date('Y-m-d', strtotime($start_date));
                $end_date = date('Y-m-d', strtotime($end_date));
                $outcome_productQuery = $IncomeProductQuery1->whereRaw("date(income_products.income_product_date) >= '" . $request->start_date . "'
             AND date(income_products.income_product_date) <= '" . $request->end_date . "'");

                $income_products = $outcome_productQuery->select('country_translations.name as country',
                    'whole_product_translations.name AS Product', 'wholesale_translations.name as admin_dep_name',
                    'income_products.country_product_type as country_product_type'
                    , DB::raw('SUM(income_products.income_product_amount) as product_amount')
                    , 'income_products.income_product_date AS date')
                    ->join('wholesale_translations', 'income_products.wholesale_id', '=', 'wholesale_translations.id')

                    ->join('country_translations', 'income_products.country_id', '=', 'country_translations.id')
                    ->join('whole_product_translations', 'income_products.whole_product_id', '=', 'whole_product_translations.id')
                    ->where('income_products.whole_product_id', $request->whole_product_id)
                    ->where('income_products.country_id', $request->country_id)
                    ->where('income_products.country_product_type', $country_product_type)
                    ->where('income_products.wholesale_id', $request->wholesale_id )
                    ->groupBy('country', 'Product', 'country_product_type', 'date', 'admin_dep_name')->get();

                return view('dashboard.admin.income_products.income_products_statistics',
                    compact('income_products', 'admin'));

            }
            elseif ($request->country_id != null && $request->whole_product_id == null && $request->wholesale_id !=null &&
                $request->country_product_type == null && $request->start_date && $request->end_date)
            {
                $IncomeProductQuery1 = IncomeProduct::query();

                $start_date = date('Y-m-d', strtotime($start_date));
                $end_date = date('Y-m-d', strtotime($end_date));
                $outcome_productQuery = $IncomeProductQuery1->whereRaw("date(income_products.income_product_date) >= '" . $request->start_date . "'
             AND date(income_products.income_product_date) <= '" . $request->end_date . "'");


                $income_products = $outcome_productQuery->select('country_translations.name as country',
                    'whole_product_translations.name AS Product', 'wholesale_translations.Name as admin_dep_name',
                    'income_products.country_product_type as country_product_type'
                    , DB::raw('SUM(income_products.income_product_amount) as product_amount')
                    , 'income_products.income_product_date AS date')
                    ->join('wholesale_translations', 'income_products.wholesale_id', '=', 'wholesale_translations.id')

                    ->join('country_translations', 'income_products.country_id', '=', 'country_translations.id')
                    ->join('whole_product_translations', 'income_products.whole_product_id', '=', 'whole_product_translations.id')

                    ->where('income_products.country_id', $request->country_id)
                    ->where('income_products.wholesale_id', $request->wholesale_id )
                    ->groupBy('country', 'Product', 'country_product_type', 'date', 'admin_dep_name')->get();
                return view('dashboard.admin.income_products.income_products_statistics', compact('income_products', 'admin'));

            }
            elseif ($request->country_id != null && $request->whole_product_id == null && $request->wholesale_id ==null &&
                $request->country_product_type == null && $request->start_date && $request->end_date)
            {
                $IncomeProductQuery1 = IncomeProduct::query();

                $start_date = date('Y-m-d', strtotime($start_date));
                $end_date = date('Y-m-d', strtotime($end_date));
                $outcome_productQuery = $IncomeProductQuery1->whereRaw("date(income_products.income_product_date) >= '" . $request->start_date . "'
             AND date(income_products.income_product_date) <= '" . $request->end_date . "'");


                $income_products = $outcome_productQuery->select('country_translations.name as country',
                    'whole_product_translations.name AS Product', 'wholesale_translations.Name as admin_dep_name',
                    'income_products.country_product_type as country_product_type'
                    , DB::raw('SUM(income_products.income_product_amount) as product_amount')
                    , 'income_products.income_product_date AS date')
                    ->join('wholesale_translations', 'income_products.wholesale_id', '=', 'wholesale_translations.id')

                    ->join('country_translations', 'income_products.country_id', '=', 'country_translations.id')
                    ->join('whole_product_translations', 'income_products.whole_product_id', '=', 'whole_product_translations.id')
                    ->where('income_products.country_id', $request->country_id)
                    ->groupBy('country', 'Product', 'country_product_type', 'date', 'admin_dep_name')->get();
                return view('dashboard.admin.income_products.income_products_statistics', compact('income_products', 'admin'));

            }
            elseif ($request->country_id != null && $request->whole_product_id != null && $request->wholesale_id !=null &&
                $request->country_product_type == null && $request->start_date && $request->end_date )
            {
                $IncomeProductQuery1 = IncomeProduct::query();

                $start_date = date('Y-m-d', strtotime($start_date));
                $end_date = date('Y-m-d', strtotime($end_date));
                $outcome_productQuery = $IncomeProductQuery1->whereRaw("date(income_products.income_product_date) >= '" . $request->start_date . "'
             AND date(income_products.income_product_date) <= '" . $request->end_date . "'");


                $income_products = $outcome_productQuery->select('country_translations.name as country',
                    'whole_product_translations.name AS Product', 'wholesale_translations.Name as admin_dep_name',
                    'income_products.country_product_type as country_product_type'
                    , DB::raw('SUM(income_products.income_product_amount) as product_amount')
                    , 'income_products.income_product_date AS date')
                    ->join('wholesale_translations', 'income_products.wholesale_id', '=', 'wholesale_translations.id')

                    ->join('country_translations', 'income_products.country_id', '=', 'country_translations.id')
                    ->join('whole_product_translations', 'income_products.whole_product_id', '=', 'whole_product_translations.id')
                    ->where('income_products.country_id', $request->country_id)
                    ->where('income_products.country_product_type', $country_product_type)
                    ->where('income_products.wholesale_id', $request->wholesale_id )
                    ->groupBy('country', 'Product', 'country_product_type', 'date', 'admin_dep_name')->get();
                return view('dashboard.admin.income_products.income_products_statistics', compact('income_products', 'admin'));

            }
            elseif ($request->country_id != null && $request->whole_product_id == null && $request->wholesale_id ==null &&
                $request->country_product_type != null && $request->start_date && $request->end_date)
            {
                $IncomeProductQuery1 = IncomeProduct::query();

                $start_date = date('Y-m-d', strtotime($start_date));
                $end_date = date('Y-m-d', strtotime($end_date));
                $outcome_productQuery = $IncomeProductQuery1->whereRaw("date(income_products.income_product_date) >= '" . $request->start_date . "'
             AND date(income_products.income_product_date) <= '" . $request->end_date . "'");


                $income_products = $outcome_productQuery->select('country_translations.name as country',
                    'whole_product_translations.name AS Product', 'wholesale_translations.Name as admin_dep_name',
                    'income_products.country_product_type as country_product_type'
                    , DB::raw('SUM(income_products.income_product_amount) as product_amount')
                    , 'income_products.income_product_date AS date')
                    ->join('wholesale_translations', 'income_products.wholesale_id', '=', 'wholesale_translations.id')

                    ->join('country_translations', 'income_products.country_id', '=', 'country_translations.id')
                    ->join('whole_product_translations', 'income_products.whole_product_id', '=', 'whole_product_translations.id')
                    ->where('income_products.country_id', $request->country_id)

                    ->where('income_products.country_product_type', $country_product_type)
                    ->groupBy('country', 'Product', 'country_product_type', 'date', 'admin_dep_name')->get();
                return view('dashboard.admin.income_products.income_products_statistics', compact('income_products', 'admin'));

            }

            elseif ($request->country_id != null && $request->whole_product_id != null && $request->wholesale_id ==null &&
                $request->country_product_type == null && $request->start_date && $request->end_date)
            {
                $IncomeProductQuery1 = IncomeProduct::query();

                $start_date = date('Y-m-d', strtotime($start_date));
                $end_date = date('Y-m-d', strtotime($end_date));
                $outcome_productQuery = $IncomeProductQuery1->whereRaw("date(income_products.income_product_date) >= '" . $request->start_date . "'
             AND date(income_products.income_product_date) <= '" . $request->end_date . "'");

                $income_products = $outcome_productQuery->select('country_translations.name as country',
                    'whole_product_translations.name AS Product', 'wholesale_translations.Name as admin_dep_name',
                    'income_products.country_product_type as country_product_type'
                    , DB::raw('SUM(income_products.income_product_amount) as product_amount')
                    , 'income_products.income_product_date AS date')
                    ->join('wholesale_translations', 'income_products.wholesale_id', '=', 'wholesale_translations.id')

                    ->join('country_translations', 'income_products.country_id', '=', 'country_translations.id')
                    ->join('whole_product_translations', 'income_products.whole_product_id', '=', 'whole_product_translations.id')

                    ->where('income_products.whole_product_id', $request->whole_product_id)
                    ->where('income_products.country_id', $request->country_id)

                    ->groupBy('country', 'Product', 'country_product_type', 'date', 'admin_dep_name')->get();
                return view('dashboard.admin.income_products.income_products_statistics', compact('income_products', 'admin'));

            }
            elseif ($request->country_id != null && $request->whole_product_id != null && $request->wholesale_id==null&&
                $request->country_product_type != null && $request->start_date && $request->end_date) {
                $IncomeProductQuery1 = IncomeProduct::query();

                $start_date = date('Y-m-d', strtotime($start_date));
                $end_date = date('Y-m-d', strtotime($end_date));
                $outcome_productQuery = $IncomeProductQuery1->whereRaw("date(income_products.income_product_date) >= '" . $request->start_date . "'
             AND date(income_products.income_product_date) <= '" . $request->end_date . "'");

                $income_products = $outcome_productQuery->select('country_translations.name as country',
                    'whole_product_translations.name AS Product', 'wholesale_translations.Name as admin_dep_name',
                    'income_products.country_product_type as country_product_type'
                    , DB::raw('SUM(income_products.income_product_amount) as product_amount')
                    , 'income_products.income_product_date AS date')
                    ->join('wholesale_translations', 'income_products.wholesale_id', '=', 'wholesale_translations.id')

                    ->join('country_translations', 'income_products.country_id', '=', 'country_translations.id')
                    ->join('whole_product_translations', 'income_products.whole_product_id', '=', 'whole_product_translations.id')
                    ->where('income_products.whole_product_id', $request->whole_product_id)
                    ->where('income_products.country_id', $request->country_id)
                    ->where('income_products.country_product_type', $country_product_type)
                    ->groupBy('country', 'Product', 'country_product_type', 'date', 'admin_dep_name')->get();
                return view('dashboard.admin.income_products.income_products_statistics', compact('income_products', 'admin'));

            }
            elseif ($request->country_id == null && $request->whole_product_id == null && $request->wholesale_id==null&&
                $request->country_product_type != null && $request->start_date && $request->end_date) {
                $IncomeProductQuery1 = IncomeProduct::query();

                $start_date = date('Y-m-d', strtotime($start_date));
                $end_date = date('Y-m-d', strtotime($end_date));
                $outcome_productQuery = $IncomeProductQuery1->whereRaw("date(income_products.income_product_date) >= '" . $request->start_date . "'
             AND date(income_products.income_product_date) <= '" . $request->end_date . "'");

                $income_products = $outcome_productQuery->select('country_translations.name as country',
                    'whole_product_translations.name AS Product', 'wholesale_translations.Name as admin_dep_name',
                    'income_products.country_product_type as country_product_type'
                    , DB::raw('SUM(income_products.income_product_amount) as product_amount')
                    , 'income_products.income_product_date AS date')
                    ->join('wholesale_translations', 'income_products.wholesale_id', '=', 'wholesale_translations.id')

                    ->join('country_translations', 'income_products.country_id', '=', 'country_translations.id')
                    ->join('whole_product_translations', 'income_products.whole_product_id', '=', 'whole_product_translations.id')
                    ->where('income_products.country_product_type', $country_product_type)
                    ->groupBy('country', 'Product', 'country_product_type', 'date', 'admin_dep_name')->get();
                return view('dashboard.admin.income_products.income_products_statistics', compact('income_products', 'admin'));

            }
            elseif ($request->country_id == null && $request->whole_product_id == null && $request->wholesale_id==null&&
                $request->country_product_type == null && $request->start_date && $request->end_date )
            {

                $IncomeProductQuery1 = IncomeProduct::query();

                $start_date = date('Y-m-d', strtotime($start_date));
                $end_date = date('Y-m-d', strtotime($end_date));
                $outcome_productQuery = $IncomeProductQuery1->whereRaw("date(income_products.income_product_date) >= '" . $request->start_date . "'
             AND date(income_products.income_product_date) <= '" . $request->end_date . "'");

                $income_products = $outcome_productQuery->select('country_translations.name as country',
                    'whole_product_translations.name AS Product', 'wholesale_translations.Name as admin_dep_name',
                    'income_products.country_product_type as country_product_type'
                    , DB::raw('SUM(income_products.income_product_amount) as product_amount')
                    , 'income_products.income_product_date AS date')
                    ->join('wholesale_translations', 'income_products.wholesale_id', '=', 'wholesale_translations.id')

                    ->join('country_translations', 'income_products.country_id', '=', 'country_translations.id')
                    ->join('whole_product_translations', 'income_products.whole_product_id', '=', 'whole_product_translations.id')

                    ->groupBy('country', 'Product', 'country_product_type', 'date', 'admin_dep_name')->get();
                return view('dashboard.admin.income_products.income_products_statistics', compact('income_products', 'admin'));

            }
            elseif ($request->country_id == null && $request->whole_product_id != null && $request->wholesale_id!=null&&
                $request->country_product_type == null && $request->start_date && $request->end_date) {

                $IncomeProductQuery1 = IncomeProduct::query();

                $start_date = date('Y-m-d', strtotime($start_date));
                $end_date = date('Y-m-d', strtotime($end_date));
                $outcome_productQuery = $IncomeProductQuery1->whereRaw("date(income_products.income_product_date) >= '" . $request->start_date . "'
             AND date(income_products.income_product_date) <= '" . $request->end_date . "'");

                $income_products = $outcome_productQuery->select('country_translations.name as country',
                    'whole_product_translations.name AS Product', 'wholesale_translations.Name as admin_dep_name',
                    'income_products.country_product_type as country_product_type'
                    , DB::raw('SUM(income_products.income_product_amount) as product_amount')
                    , 'income_products.income_product_date AS date')
                    ->join('wholesale_translations', 'income_products.wholesale_id', '=', 'wholesale_translations.id')

                    ->join('country_translations', 'income_products.country_id', '=', 'country_translations.id')
                    ->join('whole_product_translations', 'income_products.whole_product_id', '=', 'whole_product_translations.id')


                    ->where('income_products.whole_product_id', $request->whole_product_id)
                    ->where('income_products.wholesale_id', $request->wholesale_id )
                    ->groupBy('country', 'Product', 'country_product_type', 'date', 'admin_dep_name')->get();
                return view('dashboard.admin.income_products.income_products_statistics', compact('income_products', 'admin'));

            }

            elseif ($request->country_id != null && $request->whole_product_id != null && $request->wholesale_id!=null &&
                $request->country_product_type != null ) {

                $incomeQuery = IncomeProduct::query();

                $income_products = $incomeQuery->select('country_translations.name as country',
                    'whole_product_translations.name AS Product', 'wholesale_translations.Name as admin_dep_name',
                    'income_products.country_product_type as country_product_type'
                    , DB::raw('SUM(income_products.income_product_amount) as product_amount')

                    , 'income_products.income_product_date AS date')
                    ->join('wholesale_translations', 'income_products.wholesale_id', '=', 'wholesale_translations.id')

                    ->join('country_translations', 'income_products.country_id', '=', 'country_translations.id')
                    ->join('whole_product_translations', 'income_products.whole_product_id', '=', 'whole_product_translations.id')
                    ->where('income_products.whole_product_id', $request->whole_product_id)
                    ->where('income_products.country_id', $request->country_id)
                    ->where('income_products.country_product_type', $country_product_type)
                    ->where('income_products.wholesale_id', $request->wholesale_id )
                    ->groupBy('country', 'Product', 'country_product_type', 'date', 'admin_dep_name')->get();
                return view('dashboard.admin.income_products.income_products_statistics', compact('income_products', 'admin'));

            }
            elseif ($request->country_id == null && $request->whole_product_id != null && $request->wholesale_id != null &&
                $request->country_product_type != null && $request->start_date == null && $request->end_date == null) {

                $income_products = IncomeProduct::select('country_translations.name as country',
                    'whole_product_translations.name AS Product', 'wholesale_translations.Name as admin_dep_name',
                    'income_products.country_product_type as country_product_type'
                    , DB::raw('SUM(income_products.income_product_amount) as product_amount')

                    , 'income_products.income_product_date AS date')
                    ->join('wholesale_translations', 'income_products.wholesale_id', '=', 'wholesale_translations.id')

                    ->join('country_translations', 'income_products.country_id', '=', 'country_translations.id')
                    ->join('whole_product_translations', 'income_products.whole_product_id', '=', 'whole_product_translations.id')
                    ->where('income_products.whole_product_id', $request->whole_product_id)
                    ->where('income_products.country_product_type', $country_product_type)
                    ->where('income_products.wholesale_id', $request->wholesale_id )
                    ->groupBy('country', 'Product', 'country_product_type', 'date', 'admin_dep_name')->get();
                return view('dashboard.admin.income_products.income_products_statistics', compact('income_products', 'admin'));
            }
            elseif ($request->country_id != null && $request->whole_product_id != null && $request->wholesale_id != null &&
                $request->country_product_type == null && $request->start_date == null && $request->end_date == null) {

                $income_products = IncomeProduct::select('country_translations.name as country',
                    'whole_product_translations.name AS Product', 'wholesale_translations.Name as admin_dep_name',
                    'income_products.country_product_type as country_product_type'
                    , DB::raw('SUM(income_products.income_product_amount) as product_amount')

                    , 'income_products.income_product_date AS date')
                    ->join('wholesale_translations', 'income_products.wholesale_id', '=', 'wholesale_translations.id')

                    ->join('country_translations', 'income_products.country_id', '=', 'country_translations.id')
                    ->join('whole_product_translations', 'income_products.whole_product_id', '=', 'whole_product_translations.id')

                    ->where('income_products.whole_product_id', $request->whole_product_id)
                    ->where('income_products.country_id', $request->country_id)
                    ->where('income_products.wholesale_id', $request->wholesale_id )
                    ->groupBy('country', 'Product', 'country_product_type', 'date', 'admin_dep_name')->get();
                return view('dashboard.admin.income_products.income_products_statistics', compact('income_products', 'admin'));
            }
            elseif ($request->country_id != null && $request->whole_product_id == null && $request->wholesale_id == null &&
                $request->country_product_type == null && $request->start_date == null && $request->end_date == null) {
                $income_products = IncomeProduct::select('country_translations.name as country',
                    'whole_product_translations.name AS Product', 'wholesale_translations.Name as admin_dep_name',
                    'income_products.country_product_type as country_product_type'
                    , DB::raw('SUM(income_products.income_product_amount) as product_amount')

                    , 'income_products.income_product_date AS date')
                    ->join('wholesale_translations', 'income_products.wholesale_id', '=', 'wholesale_translations.id')

                    ->join('country_translations', 'income_products.country_id', '=', 'country_translations.id')
                    ->join('whole_product_translations', 'income_products.whole_product_id', '=', 'whole_product_translations.id')

                    ->where('income_products.country_id', $request->country_id)


                    ->groupBy('country', 'Product', 'country_product_type', 'date', 'admin_dep_name')->get();
                return view('dashboard.admin.income_products.income_products_statistics', compact('income_products', 'admin'));

            }
            elseif ($request->country_id != null && $request->whole_product_id == null && $request->wholesale_id != null &&
                $request->country_product_type == null && $request->start_date == null && $request->end_date == null) {

                $income_products = IncomeProduct::select('country_translations.name as country',
                    'whole_product_translations.name AS Product', 'wholesale_translations.Name as admin_dep_name',
                    'income_products.country_product_type as country_product_type'
                    , DB::raw('SUM(income_products.income_product_amount) as product_amount')

                    , 'income_products.income_product_date AS date')
                    ->join('wholesale_translations', 'income_products.wholesale_id', '=', 'wholesale_translations.id')

                    ->join('country_translations', 'income_products.country_id', '=', 'country_translations.id')
                    ->join('whole_product_translations', 'income_products.whole_product_id', '=', 'whole_product_translations.id')
                    ->where('income_products.country_id', $request->country_id)
                    ->where('income_products.wholesale_id', $request->wholesale_id )

                    ->groupBy('country', 'Product', 'country_product_type', 'date', 'admin_dep_name')->get();
                return view('dashboard.admin.income_products.income_products_statistics', compact('income_products', 'admin'));

            }
            elseif ($request->country_id != null && $request->whole_product_id != null && $request->wholesale_id == null &&
                $request->country_product_type == null && $request->start_date == null && $request->end_date == null) {

                $income_products = IncomeProduct::select('country_translations.name as country',
                    'whole_product_translations.name AS Product', 'wholesale_translations.Name as admin_dep_name',
                    'income_products.country_product_type as country_product_type'
                    , DB::raw('SUM(income_products.income_product_amount) as product_amount')

                    , 'income_products.income_product_date AS date')
                    ->join('wholesale_translations', 'income_products.wholesale_id', '=', 'wholesale_translations.id')

                    ->join('country_translations', 'income_products.country_id', '=', 'country_translations.id')
                    ->join('whole_product_translations', 'income_products.whole_product_id', '=', 'whole_product_translations.id')

                    ->where('income_products.whole_product_id', $request->whole_product_id)
                    ->where('income_products.country_id', $request->country_id)


                    ->groupBy('country', 'Product', 'country_product_type', 'date', 'admin_dep_name')->get();
                return view('dashboard.admin.income_products.income_products_statistics', compact('income_products', 'admin'));

            }
            elseif ($request->country_id != null && $request->whole_product_id != null && $request->wholesale_id == null &&
                $request->country_product_type != null && $request->start_date == null && $request->end_date == null) {

                $income_products = IncomeProduct::select('country_translations.name as country',
                    'whole_product_translations.name AS Product', 'wholesale_translations.Name as admin_dep_name',
                    'income_products.country_product_type as country_product_type'
                    , DB::raw('SUM(income_products.income_product_amount) as product_amount')

                    , 'income_products.income_product_date AS date')
                    ->join('wholesale_translations', 'income_products.wholesale_id', '=', 'wholesale_translations.id')

                    ->join('country_translations', 'income_products.country_id', '=', 'country_translations.id')
                    ->join('whole_product_translations', 'income_products.whole_product_id', '=', 'whole_product_translations.id')
                    ->where('income_products.whole_product_id', $request->whole_product_id)
                    ->where('income_products.country_id', $request->country_id)
                    ->where('income_products.country_product_type', $country_product_type)

                    ->groupBy('country', 'Product', 'country_product_type', 'date', 'admin_dep_name')->get();
                return view('dashboard.admin.income_products.income_products_statistics', compact('income_products', 'admin'));

            }
            elseif ($request->country_id != null && $request->whole_product_id == null && $request->wholesale_id == null &&
                $request->country_product_type != null && $request->start_date == null && $request->end_date == null) {

                $income_products = IncomeProduct::select('country_translations.name as country',
                    'whole_product_translations.name AS Product', 'wholesale_translations.Name as admin_dep_name',
                    'income_products.country_product_type as country_product_type'
                    , DB::raw('SUM(income_products.income_product_amount) as product_amount')

                    , 'income_products.income_product_date AS date')
                    ->join('wholesale_translations', 'income_products.wholesale_id', '=', 'wholesale_translations.id')

                    ->join('country_translations', 'income_products.country_id', '=', 'country_translations.id')
                    ->join('whole_product_translations', 'income_products.whole_product_id', '=', 'whole_product_translations.id')
                    ->where('income_products.country_id', $request->country_id)
                    ->where('income_products.country_product_type', $country_product_type)

                    ->groupBy('country', 'Product', 'country_product_type', 'date', 'admin_dep_name')->get();
                return view('dashboard.admin.income_products.income_products_statistics', compact('income_products', 'admin'));

            }
            elseif ($request->country_id == null && $request->whole_product_id == null && $request->wholesale_id==null&&
                $request->country_product_type != null && $request->start_date == null && $request->end_date == null) {


                $income_products = IncomeProduct::select('country_translations.name as country',
                    'whole_product_translations.name AS Product', 'wholesale_translations.Name as admin_dep_name',
                    'income_products.country_product_type as country_product_type'
                    , DB::raw('SUM(income_products.income_product_amount) as product_amount')

                    , 'income_products.income_product_date AS date')
                    ->join('wholesale_translations', 'income_products.wholesale_id', '=', 'wholesale_translations.id')

                    ->join('country_translations', 'income_products.country_id', '=', 'country_translations.id')
                    ->join('whole_product_translations', 'income_products.whole_product_id', '=', 'whole_product_translations.id')
                    ->where('country_product_type', $country_product_type)
                    ->groupBy('country', 'Product', 'country_product_type', 'date', 'admin_dep_name')->get();
                return view('dashboard.admin.income_products.income_products_statistics', compact('income_products', 'admin'));

            }
            elseif ($request->country_id == null && $request->whole_product_id == null && $request->wholesale_id==null&&
                $request->country_product_type == null && $request->start_date == null && $request->end_date == null) {


                $income_products = IncomeProduct::select('country_translations.name as country',
                    'whole_product_translations.name AS Product', 'wholesale_translations.Name as admin_dep_name',
                    'income_products.country_product_type as country_product_type'
                    , DB::raw('SUM(income_products.income_product_amount) as product_amount')

                    , 'income_products.income_product_date AS date')
                    ->join('wholesale_translations', 'income_products.wholesale_id', '=', 'wholesale_translations.id')

                    ->join('country_translations', 'income_products.country_id', '=', 'country_translations.id')
                    ->join('whole_product_translations', 'income_products.whole_product_id', '=', 'whole_product_translations.id')
                    ->groupBy('country', 'Product', 'country_product_type', 'date', 'admin_dep_name')->get();
                return view('dashboard.admin.income_products.income_products_statistics', compact('income_products', 'admin'));

            }
            elseif ($request->country_id == null && $request->whole_product_id != null && $request->wholesale_id!=null&&
                $request->country_product_type == null && $request->start_date == null && $request->end_date == null) {


                $income_products = IncomeProduct::select('country_translations.name as country',
                    'whole_product_translations.name AS Product', 'wholesale_translations.Name as admin_dep_name',
                    'income_products.country_product_type as country_product_type'
                    , DB::raw('SUM(income_products.income_product_amount) as product_amount')

                    , 'income_products.income_product_date AS date')
                    ->join('wholesale_translations', 'income_products.wholesale_id', '=', 'wholesale_translations.id')

                    ->join('country_translations', 'income_products.country_id', '=', 'country_translations.id')
                    ->join('whole_product_translations', 'income_products.whole_product_id', '=', 'whole_product_translations.id')
                    ->where('income_products.whole_product_id', $request->whole_product_id)
                    ->where('income_products.wholesale_id', $request->wholesale_id )
                    ->groupBy('country', 'Product', 'country_product_type', 'date', 'admin_dep_name')->get();
                return view('dashboard.admin.income_products.income_products_statistics', compact('income_products', 'admin'));

            }
        }

        elseif ($admin->type =='employee'){

            if ($request->country_id != null && $request->whole_product_id != null &&
                $request->country_product_type != null && $request->start_date && $request->end_date) {

                $IncomeProductQuery1 = IncomeProduct::query();

                $start_date = date('Y-m-d', strtotime($start_date));
                $end_date = date('Y-m-d', strtotime($end_date));
                $outcome_productQuery = $IncomeProductQuery1->whereRaw("date(income_products.income_product_date) >= 
                '" . $request->start_date . "'
             AND date(income_products.income_product_date) <= '" . $request->end_date . "'");
                $income_products = $outcome_productQuery->select('country_translations.name as country',
                    'whole_product_translations.name AS Product', 'wholesale_translations.Name as admin_dep_name',
                    'income_products.country_product_type as country_product_type'
                    , DB::raw('SUM(income_products.income_product_amount) as product_amount')

                    , 'income_products.income_product_date AS date')
                    ->join('wholesale_translations', 'income_products.wholesale_id', '=', 'wholesale_translations.id')

                    ->join('country_translations', 'income_products.country_id',
                        '=', 'country_translations.id')
                    ->join('whole_product_translations', 'income_products.whole_product_id',
                        '=', 'whole_product_translations.id')
                    ->where('income_products.whole_product_id', $request->whole_product_id)
                    ->where('income_products.country_id', $request->country_id)
                    ->where('income_products.country_product_type', $country_product_type)

                    ->where('income_products.admin_id', $admin->id)
                    ->groupBy('country', 'Product', 'country_product_type', 'date', 'admin_dep_name')->get();
                return view('dashboard.admin.income_products.income_products_statistics',
                    compact('income_products', 'admin'));

            }
            elseif ($request->countrry_id == null && $request->whole_product_id != null &&
                $request->country_product_type != null && $request->start_date && $request->end_date) {
                $IncomeProductQuery1 = IncomeProduct::query();

                $start_date = date('Y-m-d', strtotime($start_date));
                $end_date = date('Y-m-d', strtotime($end_date));
                $outcome_productQuery = $IncomeProductQuery1->whereRaw("date(income_products.income_product_date) >= 
                '" . $request->start_date . "'
             AND date(income_products.income_product_date) <= '" . $request->end_date . "'");
                $income_products = $outcome_productQuery->select('country_translations.name as country',
                    'whole_product_translations.name AS Product', 'wholesale_translations.Name as admin_dep_name',
                    'income_products.country_product_type as country_product_type'
                    , DB::raw('SUM(income_products.income_product_amount) as product_amount')

                    , 'income_products.income_product_date AS date')
                    ->join('wholesale_translations', 'income_products.wholesale_id', '=', 'wholesale_translations.id')

                    ->join('country_translations', 'income_products.country_id',
                        '=', 'country_translations.id')
                    ->join('whole_product_translations', 'income_products.whole_product_id',
                        '=', 'whole_product_translations.id')
                    ->where('income_products.whole_product_id', $request->whole_product_id)
                    ->where('income_products.country_product_type', $country_product_type)
                    ->where('income_products.admin_id', $admin->id)

                    ->groupBy('country', 'Product', 'country_product_type', 'date', 'admin_dep_name')->get();
                return view('dashboard.admin.income_products.income_products_statistics',
                    compact('income_products', 'admin'));

            }
            elseif ($request->countrry_id == null && $request->whole_product_id == null &&
                $request->country_product_type != null && $request->start_date && $request->end_date) {
                $IncomeProductQuery1 = IncomeProduct::query();

                $start_date = date('Y-m-d', strtotime($start_date));
                $end_date = date('Y-m-d', strtotime($end_date));
                $outcome_productQuery = $IncomeProductQuery1->whereRaw("date(income_products.income_product_date) >= 
                '" . $request->start_date . "'
             AND date(income_products.income_product_date) <= '" . $request->end_date . "'");
                $income_products = $outcome_productQuery->select('country_translations.name as country',
                    'whole_product_translations.name AS Product', 'wholesale_translations.Name as admin_dep_name',
                    'income_products.country_product_type as country_product_type'
                    , DB::raw('SUM(income_products.income_product_amount) as product_amount')

                    , 'income_products.income_product_date AS date')
                    ->join('wholesale_translations', 'income_products.wholesale_id', '=', 'wholesale_translations.id')

                    ->join('country_translations', 'income_products.country_id',
                        '=', 'country_translations.id')
                    ->join('whole_product_translations', 'income_products.whole_product_id',
                        '=', 'whole_product_translations.id')

                    ->where('income_products.country_product_type', $country_product_type)
                    ->where('income_products.admin_id', $admin->id)

                    ->groupBy('country', 'Product', 'country_product_type', 'date', 'admin_dep_name')->get();
                return view('dashboard.admin.income_products.income_products_statistics',
                    compact('income_products', 'admin'));
            }
            elseif ($request->countrry_id == null && $request->whole_product_id == null &&
                $request->country_product_type == null && $request->start_date && $request->end_date) {

                $IncomeProductQuery1 = IncomeProduct::query();

                $start_date = date('Y-m-d', strtotime($start_date));
                $end_date = date('Y-m-d', strtotime($end_date));
                $outcome_productQuery = $IncomeProductQuery1->whereRaw("date(income_products.income_product_date) >= 
                '" . $request->start_date . "'
             AND date(income_products.income_product_date) <= '" . $request->end_date . "'");
                $income_products = $outcome_productQuery->select('country_translations.name as country',
                    'whole_product_translations.name AS Product', 'wholesale_translations.Name as admin_dep_name',
                    'income_products.country_product_type as country_product_type'
                    , DB::raw('SUM(income_products.income_product_amount) as product_amount')

                    , 'income_products.income_product_date AS date')
                    ->join('wholesale_translations', 'income_products.wholesale_id', '=', 'wholesale_translations.id')

                    ->join('country_translations', 'income_products.country_id',
                        '=', 'country_translations.id')
                    ->join('whole_product_translations', 'income_products.whole_product_id',
                        '=', 'whole_product_translations.id')
                    ->where('income_products.admin_id', $admin->id)

                    ->groupBy('country', 'Product', 'country_product_type', 'date', 'admin_dep_name')->get();
                return view('dashboard.admin.income_products.income_products_statistics',
                    compact('income_products', 'admin'));
            }
            elseif ($request->countrry_id == null && $request->whole_product_id != null &&
                $request->country_product_type == null && $request->start_date && $request->end_date) {

                $IncomeProductQuery1 = IncomeProduct::query();

                $start_date = date('Y-m-d', strtotime($start_date));
                $end_date = date('Y-m-d', strtotime($end_date));
                $outcome_productQuery = $IncomeProductQuery1->whereRaw("date(income_products.income_product_date) >= 
                '" . $request->start_date . "'
             AND date(income_products.income_product_date) <= '" . $request->end_date . "'");
                $income_products = $outcome_productQuery->select('country_translations.name as country',
                    'whole_product_translations.name AS Product', 'wholesale_translations.Name as admin_dep_name',
                    'income_products.country_product_type as country_product_type'
                    , DB::raw('SUM(income_products.income_product_amount) as product_amount')

                    , 'income_products.income_product_date AS date')
                    ->join('wholesale_translations', 'income_products.wholesale_id', '=', 'wholesale_translations.id')

                    ->join('country_translations', 'income_products.country_id','=', 'country_translations.id')
                    ->join('whole_product_translations', 'income_products.whole_product_id',
                        '=', 'whole_product_translations.id')
                    ->where('income_products.whole_product_id', $request->whole_product_id)

                    ->where('income_products.admin_id', $admin->id)

                    ->groupBy('country', 'Product', 'country_product_type', 'date', 'admin_dep_name')->get();
                return view('dashboard.admin.income_products.income_products_statistics',
                    compact('income_products', 'admin'));
            }
            elseif ($request->countrry_id == null && $request->whole_product_id != null &&
                $request->country_product_type == null && $request->start_date && $request->end_date) {

                $IncomeProductQuery1 = IncomeProduct::query();

                $start_date = date('Y-m-d', strtotime($start_date));
                $end_date = date('Y-m-d', strtotime($end_date));
                $outcome_productQuery = $IncomeProductQuery1->whereRaw("date(income_products.income_product_date) >= 
                '" . $request->start_date . "'
             AND date(income_products.income_product_date) <= '" . $request->end_date . "'");
                $income_products = $outcome_productQuery->select('country_translations.name as country',
                    'whole_product_translations.name AS Product', 'wholesale_translations.Name as admin_dep_name',
                    'income_products.country_product_type as country_product_type'
                    , DB::raw('SUM(income_products.income_product_amount) as product_amount')

                    , 'income_products.income_product_date AS date')
                    ->join('wholesale_translations', 'income_products.wholesale_id', '=', 'wholesale_translations.id')

                    ->join('country_translations', 'income_products.country_id',
                        '=', 'country_translations.id')
                    ->join('whole_product_translations', 'income_products.whole_product_id',
                        '=', 'whole_product_translations.id')
                    ->where('income_products.whole_product_id', $request->whole_product_id)

                    ->where('income_products.admin_id', $admin->id)

                    ->groupBy('country', 'Product', 'country_product_type', 'date', 'admin_dep_name')->get();
                return view('dashboard.admin.income_products.income_products_statistics', compact('income_products', 'admin'));

            }
            elseif ($request->countrry_id != null && $request->whole_product_id != null &&
                $request->country_product_type != null && $request->start_date == null && $request->end_date == null) {


                $income_products = IncomeProduct::select('country_translations.name as country',
                    'whole_product_translations.name AS Product', 'wholesale_translations.Name as admin_dep_name',
                    'income_products.country_product_type as country_product_type'
                    , DB::raw('SUM(income_products.income_product_amount) as product_amount')

                    , 'income_products.income_product_date AS date')
                    ->join('wholesale_translations', 'income_products.wholesale_id', '=', 'wholesale_translations.id')

                    ->join('country_translations', 'income_products.country_id', '=', 'country_translations.id')
                    ->join('whole_product_translations', 'income_products.whole_product_id', '=', 'whole_product_translations.id')
                    ->where('income_products.whole_product_id', $request->whole_product_id)
                    ->where('income_products.country_id', $request->country_id)

                    ->where('income_products.admin_id', $admin->id)

                    ->where('country_product_type', $country_product_type)
                    ->groupBy('country', 'Product', 'country_product_type', 'date', 'admin_dep_name')->get();
                return view('dashboard.admin.income_products.income_products_statistics', compact('income_products', 'admin'));

            }
            elseif ($request->countrry_id == null && $request->whole_product_id != null &&
                $request->country_product_type != null && $request->start_date == null && $request->end_date == null) {

                $income_products = IncomeProduct::select('country_translations.name as country',
                    'whole_product_translations.name AS Product', 'wholesale_translations.Name as admin_dep_name',
                    'income_products.country_product_type as country_product_type'
                    , DB::raw('SUM(income_products.income_product_amount) as product_amount')

                    , 'income_products.income_product_date AS date')
                    ->join('wholesale_translations', 'income_products.wholesale_id', '=', 'wholesale_translations.id')

                    ->join('country_translations', 'income_products.country_id', '=', 'country_translations.id')
                    ->join('whole_product_translations', 'income_products.whole_product_id', '=', 'whole_product_translations.id')
                    ->where('income_products.whole_product_id', $request->whole_product_id)
                    ->where('income_products.country_product_type', $country_product_type)
                    ->where('income_products.admin_id', $admin->id)

                    ->groupBy('country', 'Product', 'country_product_type', 'date', 'admin_dep_name')->get();
                return view('dashboard.admin.income_products.income_products_statistics', compact('income_products', 'admin'));

            }
            elseif ($request->countrry_id == null && $request->whole_product_id == null &&
                $request->country_product_type != null && $request->start_date == null && $request->end_date == null) {


                $income_products = IncomeProduct::select('country_translations.name as country',
                    'whole_product_translations.name AS Product', 'wholesale_translations.Name as admin_dep_name',
                    'income_products.country_product_type as country_product_type'
                    , DB::raw('SUM(income_products.income_product_amount) as product_amount')

                    , 'income_products.income_product_date AS date')
                    ->join('wholesale_translations', 'income_products.wholesale_id', '=', 'wholesale_translations.id')

                    ->join('country_translations', 'income_products.country_id', '=', 'country_translations.id')
                    ->join('whole_product_translations', 'income_products.whole_product_id', '=', 'whole_product_translations.id')
                    ->where('income_products.country_product_type', $country_product_type)
                    ->where('income_products.admin_id', $admin->id)

                    ->groupBy('country', 'Product', 'country_product_type', 'date', 'admin_dep_name')->get();
                return view('dashboard.admin.income_products.income_products_statistics', compact('income_products', 'admin'));

            }
            elseif ($request->countrry_id == null && $request->whole_product_id == null &&
                $request->country_product_type == null && $request->start_date == null && $request->end_date == null) {



                $income_products = IncomeProduct::select('country_translations.name as country',
                    'whole_product_translations.name AS Product', 'wholesale_translations.Name as admin_dep_name',
                    'income_products.country_product_type as country_product_type'
                    , DB::raw('SUM(income_products.income_product_amount) as product_amount')

                    , 'income_products.income_product_date AS date')
                    ->join('wholesale_translations', 'income_products.wholesale_id', '=', 'wholesale_translations.id')

                    ->join('country_translations', 'income_products.country_id', '=', 'country_translations.id')
                    ->join('whole_product_translations', 'income_products.whole_product_id', '=', 'whole_product_translations.id')
                    ->where('income_products.admin_id', $admin->id)

                    ->groupBy('country', 'Product', 'country_product_type', 'date', 'admin_dep_name')->get();
                return view('dashboard.admin.income_products.income_products_statistics', compact('income_products', 'admin'));

            }
            elseif ($request->countrry_id == null && $request->whole_product_id != null &&
                $request->country_product_type == null && $request->start_date == null && $request->end_date == null) {


                $income_products = IncomeProduct::select('country_translations.name as country',
                    'whole_product_translations.name AS Product', 'wholesale_translations.Name as admin_dep_name',
                    'income_products.country_product_type as country_product_type'
                    , DB::raw('SUM(income_products.income_product_amount) as product_amount')

                    , 'income_products.income_product_date AS date')
                    ->join('wholesale_translations', 'income_products.wholesale_id', '=', 'wholesale_translations.id')

                    ->join('country_translations', 'income_products.country_id', '=', 'country_translations.id')
                    ->join('whole_product_translations', 'income_products.whole_product_id', '=', 'whole_product_translations.id')
                    ->where('income_products.whole_product_id', $request->whole_product_id)

                    ->where('income_products.admin_id', $admin->id)

                    ->groupBy('country', 'Product', 'country_product_type', 'date', 'admin_dep_name')->get();
                return view('dashboard.admin.income_products.income_products_statistics', compact('income_products', 'admin'));

            }
        }
    }


}