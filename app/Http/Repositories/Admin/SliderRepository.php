<?php
namespace App\Http\Repositories\Admin;
use App\Http\Interfaces\Admin\SliderInterface;
use App\Models\Slider;
use App\Traits\UploadT;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
class SliderRepository implements SliderInterface {
    use UploadT;
    public function index() {
        return view('dashboard.admin.sliders.index');
    }
    public function data() {
        $sliders = Slider::select();
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
            Slider::create($requestData);
            $slider = Slider::latest()->first();
            $this->addImageblog($request, 'image' , 'sliders' , 'upload_image',$slider->id, 'App\Models\Slider');
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
            if($request->image){
                $this->deleteImage('upload_image','/sliders/' . $slider->image->filename,$slider->id);
            }
            $this->addImageblog($request, 'image' , 'sliders' , 'upload_image',$slider->id, 'App\Models\slider');
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
            $this->deleteImage('upload_image','/sliders/' . $slider->image->filename,$slider->id);
            $slider->delete();
            toastr()->error(__('Admin/site.deleted_successfully'));
            return redirect()->route('sliders.index');
        } catch (\Exception $e) {
            toastr()->error(__('Admin/site.sorry'));
            return redirect()->back();
        }
    }


    public function bulkDelete($request)
    {
        if($request->delete_select_id){
                $delete_select_id = explode(",",$request->delete_select_id);
                foreach($delete_select_id as $sliders_ids){
                    $slider = Slider::findorfail($sliders_ids);
                    if($slider->image){
                        $this->deleteImage('upload_image','/sliders/' . $slider->image->filename,$slider->id);
                    }
                }
        }else{
            toastr()->error(__('Admin/site.no_data_found'));
            return redirect()->route('sliders.index');
        }
        Slider::destroy( $delete_select_id );
        toastr()->error(__('Admin/site.deleted_successfully'));
        return redirect()->route('sliders.index');
    }// end of bulkDelete


    // public function addImages() {
    //     $images = Slider::get(['photo']);
    //     return view('dashboard.admin.sliders.create', compact('images'));
    // }

    // public function saveSliderImages($request) {
    //     $file = $request->file('dzfile');
    //     $filename = uploadImage('sliders', $file);

    //     return response()->json([
    //         'name' => $filename,
    //         'original_name' => $file->getClientOriginalName(),
    //     ]);
    // }

    // public function saveSliderImagesDB($request) {
    //     try {
    //         $slider = new Slider();
    //         if ($request->has('slider') && count($request->slider) > 0) {
    //             foreach ($request->slider as $image) {
    //                 Slider::create([
    //                     $slider->photo => $image,
    //                 ]);
    //             }
    //         }
    //         toastr()->success(__('Admin/site.added_successfully'));
    //          return redirect()->route('sliders.create');
    //     } catch (\Exception $ex) {
    //         return redirect()->route('sliders.create')->withErrors(['error'=> $ex->getMessage()]);
    //     }
    // }
}
