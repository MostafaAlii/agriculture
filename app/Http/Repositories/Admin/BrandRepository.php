<?php
namespace App\Http\Repositories\Admin;
use App\Http\Interfaces\Admin\BrandInterface;
use App\Models\Brand;
use App\Traits\UploadT;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
class BrandRepository implements BrandInterface {
    use UploadT;
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
    // public function create() {
    //     return view('dashboard.admin.brands.create');
    // }

    // public function store($request) {
    //     DB::beginTransaction();
    //     try{
    //         $requestData = $request->validated();
    //         brand::create($requestData);
    //         $brand = brand::latest()->first();
    //         $this->addImageblog($request, 'image' , 'brands' , 'upload_image',$brand->id, 'App\Models\brand');
    //         DB::commit();
    //         toastr()->success(__('Admin/site.added_successfully'));
    //         return redirect()->route('brands.index');
    //      } catch (\Exception $e) {
    //          DB::rollBack();
    //          toastr()->error(__('Admin/site.sorry'));
    //          return redirect()->back();
    //      }
    // }

    // public function edit($id) {
    //     $brandID = Crypt::decrypt($id);
    //     $brand=brand::findorfail($brandID);
    //     return view('dashboard.admin.brands.edit', compact('brand'));
    // }

    // public function update($request,$id) {
    //     try{
    //         DB::beginTransaction();
    //         $brandID = Crypt::decrypt($id);
    //         $brand=brand::findorfail($brandID);
    //         $requestData = $request->validated();
    //         $brand->update($requestData);
    //         if($request->image){
    //             $this->deleteImage('upload_image','/brands/' . $brand->image->filename,$brand->id);
    //         }
    //         $this->addImageblog($request, 'image' , 'brands' , 'upload_image',$brand->id, 'App\Models\brand');
    //         DB::commit();
    //         toastr()->success( __('Admin/site.updated_successfully'));
    //         return redirect()->route('brands.index');
    //     } catch (\Exception $e) {
    //         DB::rollBack();
    //         toastr()->error(__('Admin/site.sorry'));
    //         return redirect()->back();
    //     }
    // }

    public function destroy($id) {
        try{
            $brandID = Crypt::decrypt($id);
            $brand=Brand::findorfail($brandID);
            $this->deleteImage('upload_image','/brands/' . $brand->image->filename,$brand->id);
            $brand->delete();
            toastr()->error(__('Admin/site.deleted_successfully'));
            return redirect()->route('brands.index');
        } catch (\Exception $e) {
            toastr()->error(__('Admin/site.sorry'));
            return redirect()->back();
        }
    }


    public function bulkDelete($request)
    {
        if($request->delete_select_id){
                $delete_select_id = explode(",",$request->delete_select_id);
                foreach($delete_select_id as $brands_ids){
                    $brand = Brand::findorfail($brands_ids);
                    if($brand->image){
                        $this->deleteImage('upload_image','/brands/' . $brand->image->filename,$brand->id);
                    }
                }
        }else{
            toastr()->error(__('Admin/site.no_data_found'));
            return redirect()->route('brands.index');
        }
        Brand::destroy( $delete_select_id );
        toastr()->error(__('Admin/site.deleted_successfully'));
        return redirect()->route('brands.index');
    }// end of bulkDelete

}
