<?php
namespace  App\Http\Repositories\Admin;
use App\Http\Interfaces\Admin\CountryInterface;
use App\Models\Country;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
class CountryRepository implements CountryInterface{
    public function index() {
        return view('dashboard.admin.countries.index');
    }

    public function data() {
        $countries = Country::select();
        return DataTables::of($countries)
            ->addColumn('record_select', 'dashboard.admin.countries.data_table.record_select')
            ->editColumn('created_at', function (Country $country) {
                return $country->created_at->diffForHumans();
            })
            ->addColumn('image', function (Country $country) {
                return view('dashboard.admin.countries.data_table.image', compact('country'));
            })
            ->addColumn('actions', 'dashboard.admin.countries.data_table.actions')
            ->rawColumns([ 'record_select','actions'])
            ->toJson();
    }

    public function store($request) {
        Country::create([
            'name'  => $request->input('name'),
            'created_by'    =>  auth()->user()->name,
        ]);
        toastr()->success(__('Admin/site.added_successfully'));
        return redirect()->route('Countries.index');
    }
}