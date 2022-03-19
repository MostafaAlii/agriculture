<?php
namespace App\Http\Repositories\Admin;
use App\Http\Interfaces\Admin\CountryInterface;
use App\Models\Country;
<<<<<<< HEAD
=======
use App\Models\Admin;
use App\Models\Farmer;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
>>>>>>> d794e18ddc263d92cf7f08e4591d8b7a198f0031
use Intervention\Image\Facades\Image;

use App\Models\Province;
use App\Http\Interfaces\Admin\ProvinceInterface;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;

class CountryRepository implements CountryInterface {
    public function index() {
        return view('dashboard.admin.countries.index');
    }
    public function data() {
<<<<<<< HEAD
        $countries = Country::query();

=======
        $countries = Country::with('provinces');
>>>>>>> d794e18ddc263d92cf7f08e4591d8b7a198f0031
        return DataTables::of($countries)
            ->addColumn('provinces', function (Country $country) {
                return view('dashboard.admin.countries.btn.related', compact('country'));
            })
            ->addColumn('record_select', 'dashboard.admin.countries.data_table.record_select')
            ->addIndexColumn()
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


    public function create() {
        return view('dashboard.admin.countries.create');
    }

    public function store($request) {

        DB::beginTransaction();
        try{
//
            $requestData = $request->except(['country_logo']);
            if($request->country_logo) {
                Image::make($request->country_logo)->resize(150, 150, function ($constraint) {
                    $constraint->aspectRatio();
                })->save(public_path('Dashboard/img/countryFlags/' . $request->country_logo->hashName()));
                $requestData['country_logo'] = $request->country_logo->hashName();
            }
            $country=  Country::create($requestData);
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

        $countryID = Crypt::decrypt($id);
        $country=Country::findorfail($countryID);

        return view('dashboard.admin.countries.edit', compact('country'));

    }

<<<<<<< HEAD
    public function update( $request,$id) {

            try{
                DB::beginTransaction();
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

                DB::commit();
                toastr()->success( __('Admin/site.updated_successfully'));
                return redirect()->route('countries.index');
            } catch (\Exception $e) {
                DB::rollBack();
                return redirect()->back()->withErrors(['error' => $e->getMessage()]);
=======
    public function update($request,$id) {
        $countryID = Crypt::decrypt($id);
        $country=Country::findorfail($countryID);
        $dataRequest = $request->except(['country_logo']);
        if($request->country_logo) {
            if($country->country_logo != 'default_flag.jpg') {
                Storage::disk('upload_image')->delete('/countryFlags/' . $country->country_logo);
>>>>>>> d794e18ddc263d92cf7f08e4591d8b7a198f0031
            }


    }


    public function destroy($id) {
<<<<<<< HEAD

        try{
            $countryID = Crypt::decrypt($id);
            //  dd($adminID);
            $country=Country::findorfail($countryID);
            $this->deleteImage('upload_image','/countries/' . $country->image->filename,$country->id);
            $country->delete();
            toastr()->error(__('Admin/site.deleted_successfully'));
            return redirect()->route('countries.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }


=======
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
>>>>>>> d794e18ddc263d92cf7f08e4591d8b7a198f0031
    }


    public function bulkDelete($request) {
        if($request->delete_select_id){
            $delete_select_id = explode(",",$request->delete_select_id);
            foreach($delete_select_id as $countries_ids){
                $country = Country::findorfail($countries_ids);
                if($country->image){
                    $this->deleteImage('upload_image','/admins/' . $country->image->filename,$country->id);
                }
            }
        }else{
            toastr()->error(__('Admin/site.no_data_found'));
            return redirect()->route('countries.index');
        }
        Country::destroy( $delete_select_id );
        toastr()->error(__('Admin/site.deleted_successfully'));
        return redirect()->route('countries.index');

    }// end of bulkDelete

}