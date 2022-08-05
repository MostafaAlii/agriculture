<?php
namespace  App\Http\Repositories\Admin;
use App\Models\LandCategory;

use App\Http\Interfaces\Admin\LandCategoryInterface;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
class LandCategoryRepository implements LandCategoryInterface {


    public function index() {
        $land_categories = LandCategory::query();
        return view('dashboard.admin.land_categories.index',compact('land_categories'));

    }
    public function data() {

        $land_categories = LandCategory::query()->get();
        return DataTables::of($land_categories)

            ->addColumn('record_select', 'dashboard.admin.land_categories.data_table.record_select')
            ->addIndexColumn()
            ->editColumn('created_at', function (LandCategory $land_category) {
                return $land_category ->created_at->diffforhumans();
            })
            ->editColumn('category_type', function (LandCategory $land_category) {
                return view('dashboard.admin.land_categories.data_table.category_type', compact('land_category'));
            })
            ->addColumn('actions', 'dashboard.admin.land_categories.data_table.actions')

            ->rawColumns([ 'record_select','actions'])
            ->toJson();
    }

    public function store($request) {
        try{
            $validated = $request->validated();

            LandCategory::create([
                'category_name'=>$validated['category_name'],
                'category_type'=>$validated['category_type']
            ]);


            toastr()->success(__('Admin/lands.added_successfully'));
            return redirect()->route('LandCategories.index');
        } catch (\Exception $e) {
            toastr()->error(__('Admin/attributes.add_wrong'));
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }



    }

    public function update( $request,$id) {

        try{

            $land_categoryID = Crypt::decrypt($id);
            $land_category=LandCategory::findorfail($land_categoryID);
            $land_category->category_name = $request->category_name;
            $land_category->category_type = $request->category_type;

            $land_category->update();

            toastr()->success( __('Admin/site.updated_successfully'));
            return redirect()->route('LandCategories.index');
        } catch (\Exception $e) {
            toastr()->error(__('Admin/attributes.edit_wrong'));
            return redirect()->back();

        }


    }
    public function destroy($id) {
try{
    $land_categoryID = Crypt::decrypt($id);
    $land_category=LandCategory::findorfail($land_categoryID);

    $land_category->delete();
    toastr()->success(__('Admin/site.deleted_successfully'));
    return redirect()->route('LandCategories.index');
}catch (\Exception $e) {
    toastr()->error(__('Admin/attributes.delete_wrong'));
    return redirect()->back();

}


    }

    public function bulkDelete($request) {
        try {
            DB::beginTransaction();
            if ($request->delete_select_id) {
                $delete_select_id = explode(",", $request->delete_select_id);
                foreach ($delete_select_id as $land_category_ids) {
                    $land_category=LandCategory::findorfail($land_category_ids);


                    LandCategory::destroy($land_category_ids);
                }
                DB::commit();

                toastr()->error(__('Admin/site.deleted_successfully'));
                return redirect()->route('LandCategories.index');
            } else {
                toastr()->error(__('Admin/site.no_data_found'));
                return redirect()->route('LandCategories.index');
            }
        }catch (\Exception $e) {
            DB::rollBack();
            toastr()->error(__('Admin/attributes.delete_wrong'));

            return redirect()->back();

        }


    }// end of bulkDelete

}