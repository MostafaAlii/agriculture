<?php
namespace App\Http\Repositories\Admin;
use App\Models\Brand;
use App\Traits\{HasImage};
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\{Crypt, DB};
use App\Http\Interfaces\Admin\BrandInterface;
class BrandRepository implements BrandInterface {
    use  HasImage;
    public function index() {
        return view('dashboard.admin.brands.index');
    }
    
    public function data() {
        $brands = Brand::select();
        return DataTables::of($brands)
            ->addColumn('record_select', 'dashboard.admin.brands.data_table.record_select')
            ->addIndexColumn()
            ->editColumn('created_at', function (Brand $brand) {
                return $brand->created_at->format('Y-m-d');
            })
            ->addColumn('image', function (Brand $brand) {
                return view('dashboard.admin.brands.data_table.image', compact('brand'));
            })
            ->addColumn('actions', 'dashboard.admin.brands.data_table.actions')
            ->rawColumns([ 'record_select','actions'])
            ->toJson();
    }
    
    public function create() {
        return view('dashboard.admin.brands.create');
    }

    public function store($request) {
        DB::beginTransaction();
        try{
            $requestData = $request->validated();
            $brand = Brand::create($requestData);
           if($request->hasFile('image')) {
                $image = $request->file('image');
                $name = 'brand-'.time().Str::slug($request->input('title'));
                $filename = $name .'.'.$image->getClientOriginalName();
                $brand->storeImage($image->storeAs('brands', $filename, 'public'));
           }
            DB::commit();
            toastr()->success(__('Admin/site.added_successfully'));
            return redirect()->route('brands.index');
         }catch (\Exception $e){
            DB::rollback();
            toastr()->error(__('Admin/site.error'));
            return redirect()->route('brands.index');
         }
    }

    public function edit($id) {
        $brandID = Crypt::decrypt($id);
        $brand=Brand::findorfail($brandID);
        return view('dashboard.admin.brands.edit', compact('brand'));
    }

    public function update($request,$id) {
        try{
            DB::beginTransaction();
            $brandID = Crypt::decrypt($id);
            $brand=Brand::findorfail($brandID);
            $requestData = $request->validated();
            $brand->update($requestData);
            if($request->hasFile('image')) {
                $image = $request->file('image');
                $name = 'brand-'.time().Str::slug($request->input('title'));
                $filename = $name .'.'.$image->getClientOriginalName();
                $brand->updateImage($image->storeAs('brands', $filename, 'public'));
           }
            DB::commit();
            toastr()->success( __('Admin/site.updated_successfully'));
            return redirect()->route('brands.index');
        } catch (\Exception $e) {
            DB::rollBack();
            toastr()->error(__('Admin/site.sorry'));
            return redirect()->back();
        }
    }

    public function destroy($id) {
        try{
            $brandID = Crypt::decrypt($id);
            $brand=Brand::findorfail($brandID);
            $brand->delete();
            toastr()->error(__('Admin/site.deleted_successfully'));
            return redirect()->route('brands.index');
        } catch (\Exception $e) {
            toastr()->error(__('Admin/site.sorry'));
           return redirect()->back();
        }
    }
    
    public function bulkDelete($request) {
        if($request->delete_select_id){
            $delete_select_id = explode(",",$request->delete_select_id);
            foreach($delete_select_id as $brands_ids){
                $brand = Brand::findorfail($brands_ids);
                if($brand->image && $brand->image != 'default_brand.jpg'){
                    $old_photo = $brand->image->filename;
                    $brand->deleteImage();
                }
            }
        }else{
            toastr()->error(__('Admin/site.no_data_found'));
            return redirect()->route('brands.index');
        }
        Brand::destroy( $delete_select_id );
        toastr()->error(__('Admin/site.deleted_successfully'));
        return redirect()->route('brands.index');
    }
}