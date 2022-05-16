<?php
namespace App\Http\Repositories\Admin;

use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Crypt;
use App\Http\Interfaces\Admin\ReviewInterface;
use App\Models\Review;

class ReviewRepository implements ReviewInterface {
    
    public function index() {
       // dd('fff');
        return view('dashboard.admin.reviews.index');
    }
//------------------------------------------------------------------------------------------
    public function data() {
        $review = Review::get();
        return DataTables::of($review)
            ->addColumn('record_select', 'dashboard.admin.reviews.data_table.record_select')
            ->editColumn('created_at', function (Review $review) {
                return $review->created_at->diffforhumans();
            })
            ->editColumn('message', function (Review $review) {
                return substr($review->message,0,50).' ....';
            })
            ->addColumn('status', function (Review $review) {
                return view('dashboard.admin.reviews.data_table.show_hide',compact('review'));
                // if($review->show_or_hide=='1'){
                //     $v='<a><span class="glyphicon glyphicon-ok"></span></a>';
                // }else{
                //     $v='<span class="glyphicon glyphicon-remove"></span>';
                // }
                // return $v;
            })
            ->addColumn('actions', 'dashboard.admin.reviews.data_table.actions')
            ->rawColumns([ 'record_select','actions'])
            ->toJson();
    }
//------------------------------------------------------------------------------------------
    public function store($request) {
    //  dd('gggg');
        try{
            $review=new Review();
            $review->name=$request->name;
            $review->email=$request->email;
            $review->message=$request->message;
            $review->show_or_hide=$request->show_or_hide;
            $review->save();
            toastr()->success(__('Admin/attributes.added_done'));
            return redirect()->route('review.index');   
         } catch (\Exception $ex) {
            toastr()->success(__('Admin/attributes.add_wrong'));
            return redirect()->route('review.index');
         }
    }
//------------------------------------------------------------------------------------------
    public function edit($id) {
        $real_id = Crypt::decrypt($id);
        $review = Review::orderBy('id', 'DESC')->find($real_id);
       return view('dashboard.admin.reviews.edit', compact('review'));
    }
//------------------------------------------------------------------------------------------
    public function update($request,$id) {
        try{
            $real_id = Crypt::decrypt($id);

            $review=Review::findOrfail($real_id);
            $review->name=$request->name;
            $review->email=$request->email;
            $review->message=$request->message;
            $review->show_or_hide=$request->show_or_hide;
            $review->save();
            
            toastr()->success(__('Admin/attributes.updated_done'));
            return redirect()->route('review.index');
        } catch (\Exception $ex) {
            toastr()->success(__('Admin/attributes.edit_wrong'));
            return redirect()->route('review.index');
         }
    }
//------------------------------------------------------------------------------------------
    public function destroy($id) {
        try{
            $real_id = decrypt($id);

                Review::findorfail($real_id)->delete();
                toastr()->error(__('Admin/attributes.delete_done'));
                return redirect()->route('review.index');
           
        } catch (\Exception $e) {
            toastr()->success(__('Admin/attributes.delete_wrong'));
            return redirect()->route('review.index');
        }
    }
    
//------------------------------------------------------------------------------------------
    public function bulkDelete($request)
    {
       // dd($request->delete_select_id);
        if($request->delete_select_id){
            $all_ids = explode(',',$request->delete_select_id);

            $delete_or_no=0;
            
            foreach($all_ids as $ids){
                
                    Review::findorfail($ids)->delete();
                    $delete_or_no++;
            }
            if($delete_or_no==0){
                toastr()->error(__('Admin/attributes.cant_delete'));
                return redirect()->route('review.index');
            }else{
                toastr()->error(__('Admin/attributes.delete_done'));
                return redirect()->route('review.index');
            }
        }else{
            toastr()->error(__('Admin/site.no_data_found'));
            return redirect()->route('review.index');
        }
    }// end of bulkDelete
}