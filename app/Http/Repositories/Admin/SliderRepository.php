<?php
namespace App\Http\Repositories\Admin;
use App\Models\Slider;
use App\Traits\HasImage;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use App\Http\Interfaces\Admin\SliderInterface;

class SliderRepository implements SliderInterface {
    use HasImage;
    public function index() {
        return view('dashboard.admin.sliders.index');
    }
    public function data() {
        $sliders = Slider::get();
        return DataTables::of($sliders)
            ->addColumn('record_select', 'dashboard.admin.sliders.data_table.record_select')
            ->addIndexColumn()
            ->editColumn('created_at', function (Slider $slider) {
                return $slider->created_at->format('Y-m-d');
            })
            ->addColumn('image', function (Slider $slider) {
                return view('dashboard.admin.sliders.data_table.image', compact('slider'));
            })
            ->addColumn('actions', 'dashboard.admin.sliders.data_table.actions')
            ->rawColumns([ 'record_select','actions'])
            ->toJson();
    }
    public function create() {
        return view('dashboard.admin.sliders.create');
    }

    public function store($request) {
        DB::beginTransaction();
        try{
            $requestData = $request->validated();
            $slider = Slider::create($requestData);
            if($request->hasFile('image')) {
                $image = $request->file('image');
                $name = 'slider-'.time().Str::slug($request->input('title'));
                $filename = $name .'.'.$image->getClientOriginalName();
                $slider->storeImage($image->storeAs('sliders', $filename, 'public'));
           }
            DB::commit();
            toastr()->success(__('Admin/site.added_successfully'));
            return redirect()->route('sliders.index');
         } catch (\Exception $e) {
             DB::rollBack();
             toastr()->error(__('Admin/site.sorry'));
             return redirect()->back();
         }
    }

    public function edit($id) {
        $sliderID = Crypt::decrypt($id);
        $slider=Slider::findorfail($sliderID);
        return view('dashboard.admin.sliders.edit', compact('slider'));
    }

    public function update($request,$id) {
        try{
            DB::beginTransaction();
            $sliderID = Crypt::decrypt($id);
            $slider=Slider::findorfail($sliderID);
            $requestData = $request->validated();
            $slider->update($requestData);
            if($request->hasFile('image')) {
                $image = $request->file('image');
                $name = 'slider-'.time().Str::slug($request->input('title'));
                $filename = $name .'.'.$image->getClientOriginalName();
                $slider->updateImage($image->storeAs('sliders', $filename, 'public'));
           }
            DB::commit();
            toastr()->success( __('Admin/site.updated_successfully'));
            return redirect()->route('sliders.index');
        } catch (\Exception $e) {
            DB::rollBack();
            toastr()->error(__('Admin/site.sorry'));
            return redirect()->back();
        }
    }

    public function destroy($id) {
        try{
            $sliderID = Crypt::decrypt($id);
            $slider=Slider::findorfail($sliderID);
            $slider->delete();
            toastr()->error(__('Admin/site.deleted_successfully'));
            return redirect()->route('sliders.index');
        } catch (\Exception $e) {
            toastr()->error(__('Admin/site.sorry'));
            return redirect()->back();
        }
    }


    public function bulkDelete($request) {
        if($request->delete_select_id){
                $delete_select_id = explode(",",$request->delete_select_id);
                foreach($delete_select_id as $sliders_ids){
                    $slider = Slider::findorfail($sliders_ids);
                    if($slider->image && $slider->image != 'default_brand.jpg'){
                        $old_photo = $slider->image->filename;
                        $slider->deleteImage();
                    }
                }
        }else{
            toastr()->error(__('Admin/site.no_data_found'));
            return redirect()->route('sliders.index');
        }
        Slider::destroy( $delete_select_id );
        toastr()->error(__('Admin/site.deleted_successfully'));
        return redirect()->route('sliders.index');
    }
}   