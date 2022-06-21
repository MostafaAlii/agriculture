<?php

namespace App\Http\Repositories\Admin;

use App\Models\Currency;

use App\Http\Interfaces\Admin\CurrencyInterface;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;

class CurrencyRepository implements CurrencyInterface
{

    public function index()
    {

        return view('dashboard.admin.currencies.index');
    }

    public function data()
    {

        $currencies = Currency::query()->get();
        return DataTables::of($currencies)
            ->addIndexColumn()
            ->editColumn('created_at', function (Currency $currency) {
                return $currency->created_at->diffforhumans();
            })
            ->addColumn('actions', 'dashboard.admin.currencies.data_table.actions')
            ->rawColumns(['actions'])
            ->toJson();
    }

    public function store($request)
    {
        try {
            $validated = $request->validated();
            $currency = new Currency();
            $currency->Name = $validated['Name'];


            $currency->save();

            toastr()->success(__('Admin/country.added_successfully'));
            return redirect()->route('Currencies.index');
        } catch (\Exception $e) {
            toastr()->error(__('Admin/attributes.add_wrong'));

            return redirect()->back();

        }


    }

    public function update($request, $id)
    {

        try {

            $currencyId = Crypt::decrypt($id);
            $currency = Currency::findorfail($currencyId);
            $currency->Name = $request->Name;

            $currency->update();

            DB::commit();
            toastr()->success(__('Admin/site.updated_successfully'));
            return redirect()->route('Currencies.index');
        } catch (\Exception $e) {
            toastr()->error(__('Admin/attributes.edit_wrong'));
            return redirect()->back();

        }


    }
//
//    public function destroy($id) {
//
//        $currencyID = Crypt::decrypt($id);
//
//        $currency=Currency::findorfail($currencyID);
//
//        $currency->delete();
//            toastr()->success(__('Admin/site.deleted_successfully'));
//            return redirect()->route('Currencies.index');
//
//    }
//
//
//    public function bulkDelete($request) {
//        try {
//            DB::beginTransaction();
//            if ($request->delete_select_id) {
//                $delete_select_id = explode(",", $request->delete_select_id);
//                foreach ($delete_select_id as $currency_id) {
//                    $currency = Currency::findorfail($currency_id);
//                    $currency->delete();
//
//                }
//                DB::commit();
//
//                toastr()->error(__('Admin/site.deleted_successfully'));
//                return redirect()->route('Currencies.index');
//            } else {
//                toastr()->error(__('Admin/site.no_data_found'));
//                return redirect()->route('Currencies.index');
//            }
//        }catch (\Exception $e) {
//            DB::rollBack();
//            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
//
//        }
//
//
//    }// end of bulkDelete

}