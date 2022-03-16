<?php
namespace  App\Http\Repositories\Admin;
use App\Models\Country;
use App\Http\Interfaces\Admin\CountryInterface;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use App\Traits\UploadT;


class CountryRepository implements CountryInterface{

    use UploadT;
    public function index() {
        return view('dashboard.admin.countries.index');
    }
    public function data() {
        $countries = Country::query();

        return DataTables::of($countries)
            ->editColumn('created_at', function (Country $country) {
                return $country->created_at->format('Y-m-d');
            })
            ->addColumn('actions', 'dashboard.admin.countries.data_table.actions')
            ->rawColumns([ 'actions'])
            ->toJson();
    }

    public function create() {

     return view('dashboard\admin\countries.create');
    }


    public function store($request) {
         DB::beginTransaction();
        try{
            $requestData = $request->validated();


            $country = Country::create($requestData);
            $country->name = $request->name;
            $country->save();

            DB::commit();

            toastr()->success(__('Admin/country.added_successfully'));
            return redirect()->route('countries.index');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function edit($id) {
          $id_country  = Crypt::decrypt($id);
        $country = Country::findorfail($id_country);
        return view('dashboard.admin.countries.edit', compact('country'));
    }

        public function update( $request,$id) {
            try{
                $country=Country::findorfail($id);
                $requestData = $request->validated();
                $requestData['name'] = $request->name;
                $country->update($requestData);
                toastr()->success( __('Admin/site.updated_successfully'));
                return redirect()->route('countries.index');
            } catch (\Exception $e) {
                return redirect()->back()->withErrors(['error' => $e->getMessage()]);
            }
        }


    public function destroy($id) {
        $country=Country::findorfail($id);
        $country->delete();
        toastr()->error(__('Admin/country.deleted_successfully'));
        return redirect()->route('countries.index');
    }
}