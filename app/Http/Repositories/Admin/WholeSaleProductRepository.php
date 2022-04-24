<?php
namespace  App\Http\Repositories\Admin;
use App\Http\Interfaces\Admin\WholeSaleProductInterface;
use App\Models\WholeSaleProduct;

use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
class WholeSaleProductRepository implements WholeSaleProductInterface{
    public function index() {
        return view('dashboard.admin.whole_sale_products.index');

    }
    public function data() {

        $whole_products = WholeSaleProduct::query();
        return DataTables::of($whole_products)

            ->addColumn('record_select', 'dashboard.admin.whole_sale_products.data_table.record_select')
            ->addIndexColumn()
            ->editColumn('created_at', function (WholeSaleProduct $whole_product) {
                return $whole_product->created_at->diffforhumans();
            })

            ->addColumn('actions', 'dashboard.admin.whole_sale_products.data_table.actions')

            ->rawColumns([ 'record_select','actions'])
            ->toJson();
    }

    public function store( $request) {
        DB::beginTransaction();
        try{
            $validated = $request->validated();
            $whole_sale_product = new WholeSaleProduct();
            $whole_sale_product->name = $validated['name'];
            $whole_sale_product->save();

            DB::commit();

            toastr()->success(__('Admin/whole_products.added_successfully'));
            return redirect()->route('WholeSaleProducts.index');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }



    }
    public function update( $request,$id) {

        try{
            DB::beginTransaction();

           $whole_productID = Crypt::decrypt($id);
            $validated = $request->validated();

            $whole_product=WholeSaleProduct::findorfail($whole_productID);
            $whole_product->name = $validated['name'];

            $whole_product->update($validated);

            DB::commit();
            toastr()->success( __('Admin/site.updated_successfully'));
            return redirect()->route('WholeSaleProducts.index');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);

        }


    }



    public function destroy($id) {

        $whole_productID = WholeSaleProduct::decrypt($id);
        $whole_product = WholeSaleProduct::findorfail($whole_productID)->first();
        WholeSaleProduct::destroy($whole_productID);
        toastr()->success(__('Admin/site.deleted_successfully'));
        return redirect()->route('WholeSaleProducts.index');


    }

    public function bulkDelete($request) {
        try {
            DB::beginTransaction();
            if ($request->delete_select_id) {
                $delete_select_id = explode(",", $request->delete_select_id);
                foreach ($delete_select_id as $whole_productID) {

                    WholeSaleProduct::destroy($whole_productID);
                }
                DB::commit();

                toastr()->error(__('Admin/site.deleted_successfully'));
                return redirect()->route('WholeSaleProducts.index');
            } else {
                toastr()->error(__('Admin/site.no_data_found'));
                return redirect()->route('WholeSaleProducts.index');
            }
        }catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);

        }


    }// end of bulkDelete

}