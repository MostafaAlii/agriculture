<?php

namespace App\Http\Repositories\Admin;

use App\Http\Interfaces\Admin\WholeSaleProductInterface;
use App\Models\WholeProduct;

use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class WholeSaleProductRepository implements WholeSaleProductInterface
{
    public function index()
    {
        return view('dashboard.admin.whole_sale_products.index');

    }

    public function data()
    {

        $whole_products = WholeProduct::query();
        return DataTables::of($whole_products)
            ->addColumn('record_select', 'dashboard.admin.whole_sale_products.data_table.record_select')
            ->addIndexColumn()
            ->editColumn('created_at', function (WholeProduct $whole_product) {
                return $whole_product->created_at->diffforhumans();
            })
            ->addColumn('actions', 'dashboard.admin.whole_sale_products.data_table.actions')
            ->rawColumns(['record_select', 'actions'])
            ->toJson();
    }

    public function store($request)
    {
        try {
            $validated = $request->validated();
            $whole_sale_product = new WholeProduct();
            $whole_sale_product->name = $validated['name'];
            $whole_sale_product->save();


            toastr()->success(__('Admin/site.added_successfully'));
            return redirect()->route('WholeSaleProducts.index');
        } catch (\Exception $e) {
            toastr()->success(__('Admin/attributes.add_wrong'));
            return redirect()->back();
        }


    }

    public function update($request, $id)
    {

        try {

            $whole_productID = Crypt::decrypt($id);
            $validated = $request->validated();

            $whole_product = WholeProduct::findorfail($whole_productID);
            $whole_product->name = $validated['name'];

            $whole_product->update($validated);

            toastr()->success(__('Admin/site.updated_successfully'));
            return redirect()->route('WholeSaleProducts.index');
        } catch (\Exception $e) {
            toastr()->success(__('Admin/attributes.edit_wrong'));
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);

        }


    }


    public function destroy($id)
    {
        try {
            $whole_productID = Crypt::decrypt($id);
            $whole_product = WholeProduct::findorfail($whole_productID)->first();
            $whole_product->delete();
            toastr()->success(__('Admin/site.deleted_successfully'));
            return redirect()->route('WholeSaleProducts.index');
        } catch (\Exception $e) {
            toastr()->success(__('Admin/attributes.delete_wrong'));
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);

        }


    }

    public function bulkDelete($request)
    {
        try {
            DB::beginTransaction();
            if ($request->delete_select_id) {
                $delete_select_id = explode(",", $request->delete_select_id);
                foreach ($delete_select_id as $whole_productID) {

                    WholeProduct::destroy($whole_productID);
                }
                DB::commit();

                toastr()->error(__('Admin/site.deleted_successfully'));
                return redirect()->route('WholeSaleProducts.index');
            } else {
                toastr()->error(__('Admin/site.no_data_found'));
                return redirect()->route('WholeSaleProducts.index');
            }
        } catch (\Exception $e) {
            DB::rollBack();
            toastr()->success(__('Admin/attributes.delete_wrong'));

            return redirect()->back()->withErrors(['error' => $e->getMessage()]);

        }


    }// end of bulkDelete

}