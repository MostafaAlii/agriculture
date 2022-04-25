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
        return view('dashboard.admin.income_products.index') ;
    }

    public function data()
    {
        $incomes = IncomeProduct::with('area','country','province','adminDepartment','whole_product');

        return DataTables::of($incomes)
            ->addColumn('record_select', 'dashboard.admin.income_products.data_table.record_select')
            ->addIndexColumn()
            ->editColumn('created_at', function (IncomeProduct $income) {
                return $income ->created_at->diffforhumans();
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
            ->addColumn('adminDepartment', function (IncomeProduct $income) {
                return $income->adminDepartment->dep_name_ar;
            })
            ->addColumn('whole_product', function (IncomeProduct $income) {
                return $income->whole_product->name;
            })



            ->addColumn('actions', 'dashboard.admin.income_products.data_table.actions')
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


        return view('dashboard.admin.income_products.create',
            compact( 'whole_products', 'areas', 'provinces', 'countries','admin_dpartments','units','currencies'));
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

            $income_product->admin_department_id = $requestData['admin_department_id'];
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
        $admins = Admin::all();
        $admin_dpartments = AdminDepartment::all();
        $units = Unit::all();
        $currencies = Currency::all();

        return view('dashboard.admin.income_products.edit',
            compact('admin_dpartments', 'areas', 'provinces','countries', 'units',
                'income_product','whole_products','currencies'));
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
            $income_product->currency_id = $requestData['currency_id'];

            $income_product->income_product_amount = $requestData['income_product_amount'];
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
}