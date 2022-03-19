<?php
namespace App\Http\Repositories\Admin;
use App\Http\Interfaces\Admin\CountryInterface;
use App\Models\Country;
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
        $countries = Country::query();

        return DataTables::of($countries)
            ->addColumn('record_select', 'dashboard.admin.countries.data_table.record_select')
            ->addIndexColumn()
            ->editColumn('created_at', function (Country $country) {
                return $country->created_at->format('Y-m-d');
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
            }


    }


    public function destroy($id) {

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