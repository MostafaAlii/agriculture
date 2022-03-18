<?php
namespace  App\Http\Repositories\Admin;
use App\Http\Interfaces\Admin\CountryInterface;
use App\Models\Country;
use App\Models\Admin;
use App\Models\Farmer;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use App\Traits\UploadT;
class CountryRepository implements CountryInterface{
    use UploadT;
    public function index() {
        return view('dashboard.admin.countries.index');
    }

    public function data() {
        $countries = Country::with('provinces');
        return DataTables::of($countries)
        ->addColumn('provinces', function (Country $country) {
            return view('dashboard.admin.countries.btn.related', compact('country'));
        })
            ->addColumn('record_select', 'dashboard.admin.countries.data_table.record_select')
            ->editColumn('created_at', function (Country $country) {
                return $country->created_at->diffforhumans();
            })
            ->addColumn('image', function (Country $country) {
                return view('dashboard.admin.countries.data_table.image', compact('country'));
            })
            ->addColumn('actions', 'dashboard.admin.countries.data_table.actions')
            ->rawColumns([ 'record_select','actions'])
            ->toJson();
    }

    public function store($request) {
        $dataRequest = $request->except(['country_logo']);
        if($request->country_logo) {
            Image::make($request->country_logo)->resize(150, 150, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('Dashboard/img/countryFlags/' . $request->country_logo->hashName()));
            $dataRequest['country_logo'] = $request->country_logo->hashName();
        }
        Country::create($dataRequest);
        toastr()->success(__('Admin/site.added_successfully'));
        return redirect()->route('Countries.index');
    }

    public function edit($id) {
        $countryID = Crypt::decrypt($id);
        $country=Country::findorfail($countryID);
        return view('dashboard.admin.countries.edit', compact('country'));
    }

    public function update($request,$id) {
        $countryID = Crypt::decrypt($id);
        $country=Country::findorfail($countryID);
        $dataRequest = $request->except(['country_logo']);
        if($request->country_logo) {
            if($country->country_logo != 'default_flag.jpg') {
                Storage::disk('upload_image')->delete('/countryFlags/' . $country->country_logo);
            }
            Image::make($request->country_logo)->resize(150, 150, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('Dashboard/img/countryFlags/' . $request->country_logo->hashName()));
            $dataRequest['country_logo'] = $request->country_logo->hashName();
        }
        $country->update($dataRequest);
        toastr()->success(__('Admin/site.edit_successfully'));
        return redirect()->route('Countries.index');
    }

    public function destroy($id) {
        $data = [];
        $countryID = Crypt::decrypt($id);
        $data['admin'] = Admin::where('country_id', $countryID)->pluck('country_id');
        $data['farmer'] = Farmer::where('country_id', $countryID)->pluck('country_id');
        $data['user'] = User::where('country_id', $countryID)->pluck('country_id'); 
        if($data['admin']->count() == 0  && $data['farmer']->count() == 0 && $data['user']->count() == 0) {
            $country=Country::findorfail($countryID);
            if($country->country_logo != 'default_flag.jpg') {
                Storage::disk('upload_image')->delete('/countryFlags/' . $country->country_logo);
            }
            $country->delete();
            toastr()->success(__('Admin/site.deleted_successfully'));
            return redirect()->route('Countries.index');
        } else {
            toastr()->error(__('Admin/countries.cant_delete'));
            return redirect()->route('Countries.index');
        }
    }
}
