<?php
namespace App\Http\Repositories\Admin;
use App\Http\Interfaces\Admin\CountryInterface;
use App\Models\Country;
use App\Models\CountryTranslation;
use App\Models\Admin;
use App\Models\Farmer;

use App\Models\Province;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Intervention\Image\Facades\Image;

use App\Http\Interfaces\Admin\ProvinceInterface;
use App\Traits\UploadT;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class CountryRepository implements CountryInterface {
    use UploadT;
    public function index() {
        return view('dashboard.admin.countries.index');
    }
    public function data() {

        $countries = Country::with('provinces')->get();

        return DataTables::of($countries)
            ->addColumn('provinces', function (Country $country) {
                return view('dashboard.admin.countries.btn.related', compact('country'));
            })

            ->addColumn('record_select', 'dashboard.admin.countries.data_table.record_select')
            ->addIndexColumn()
            ->addColumn('created_at', function (Country $country) {
                return $country->created_at->diffforhumans();
            })

            ->addColumn('image', function (Country $country) {
                return view('dashboard.admin.countries.data_table.image', compact('country'));
            })
            ->addColumn('name', function (Country $country) {
                return $country->country_trans->name;
            })

            ->addColumn('actions', 'dashboard.admin.countries.data_table.actions')


            ->rawColumns([ 'record_select','actions'])

            ->toJson();
    }


    public function create() {
        return view('dashboard.admin.countries.create');
    }

    public function store($request) {

        try{

            $requestData = $request->except(['image']);
            if($request->image) {
                Image::make($request->image)->resize(150, 150, function ($constraint) {
                    $constraint->aspectRatio();
                })->save(public_path('Dashboard/img/countries/' . $request->image->hashName()));
                $requestData['country_logo'] = $request->image->hashName();
            }
            $country=  Country::create($requestData);
            $country->name = $request->name;
            $country->save();

            toastr()->success(__('Admin/country.added_successfully'));
            return redirect()->route('Countries.index');
        } catch (\Exception $e) {
            toastr()->error(__('Admin/attributes.add_wrong'));

            return redirect()->back()->withErrors(['error' => $e->getMessage()]);        }

    }
    public function edit($id) {

        $countryID = Crypt::decrypt($id);
        $country=Country::findorfail($countryID);

        return view('dashboard.admin.countries.edit', compact('country'));

    }

    public function update( $request,$id) {
//        return $request;
            try{
                $countryID = Crypt::decrypt($id);
                $country=Country::findorfail($countryID);

                $dataRequest = $request->except(['image']);


                if($request->image) {

                    if(File::exists('Dashboard/img/countries/' . $country->country_logo))
                    {
                        File::delete('Dashboard/img/countries/' . $country->country_logo);
                    }
                    Image::make($request->image)->resize(70, 70, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save(public_path('/Dashboard/img/countries/' . $request->image->hashName()));

                    $dataRequest['country_logo'] = $request->image->hashName();
                }
                $country->update($dataRequest);

                toastr()->success( __('Admin/site.updated_successfully'));
                return redirect()->route('Countries.index');
            } catch (\Exception $e) {
                toastr()->error(__('Admin/attributes.edit_wrong'));

                return redirect()->back();

            }


    }


    public function destroy($id) {
        try{
            $countryID = Crypt::decrypt($id);
            $admin_count= Admin::where('country_id','=',$countryID)->count();
            $farmer_count= Farmer::where('country_id','=',$countryID)->count();
            $country=Country::findorfail($countryID);
            $province_count = $country->provinces->count();
            if($province_count == 0 && $admin_count==0 && $farmer_count==0 ) {
            if(File::exists('Dashboard/img/countries/' . $country->country_logo))
            {
                File::delete('Dashboard/img/countries/' . $country->country_logo);
            }

                $country->delete();
                toastr()->success(__('Admin/site.deleted_successfully'));
                return redirect()->route('Countries.index');
            } else {
                toastr()->error(__('Admin/countries.cant_delete'));
                return redirect()->route('Countries.index');
            }
        }catch (\Exception $e) {
            toastr()->error(__('Admin/attributes.delete_wrong'));
            return redirect()->back()->withErrors(['error'=>$e->getMessage()]);
        }


    }


    public function bulkDelete($request) {
        try {
            DB::beginTransaction();
            if ($request->delete_select_id) {
                $delete_select_id = explode(",", $request->delete_select_id);
                foreach ($delete_select_id as $countries_ids) {
                    $countries_ids = Crypt::decrypt($countries_ids);
                    $country = Country::findorfail($countries_ids);
                    $provinces = $country->provinces->count();
                    if ($provinces > 0) {
                        toastr()->error(__('Admin/countries.delete_related_provinces'));
                        return redirect()->route('Countries.index');
                    }
                    if(File::exists('Dashboard/img/countries/' . $country->country_logo))
                    {
                        File::delete('Dashboard/img/countries/' . $country->country_logo);
                    }
                    Country::destroy($countries_ids);
                }
                DB::commit();

                toastr()->error(__('Admin/site.deleted_successfully'));
                return redirect()->route('Countries.index');
            } else {
                toastr()->error(__('Admin/site.no_data_found'));
                return redirect()->route('Countries.index');
            }
        }catch (\Exception $e) {
            DB::rollBack();
            toastr()->error(__('Admin/countries.cant_delete'));

            return redirect()->back();
        }


    }// end of bulkDelete

}
