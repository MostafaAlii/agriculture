<?php
namespace App\Http\Repositories\Admin;

use App\Models\Admin;
use App\Models\State;
use App\Models\Farmer;
use App\Models\Country;
use App\Models\User;

use App\Models\Department;
use Yajra\DataTables\DataTables;
use App\Http\Interfaces\Admin\TagInterface;
use App\Models\Tag;
use Yoeunes\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Crypt;
class TagRepository implements TagInterface {

    public function data($request) {
        if(request()->ajax()) {
            return datatables()->of(Tag::select('*'))
            ->addColumn('record_select', 'dashboard.admin.tags.data_table.record_select')
            ->addIndexColumn()
            ->editColumn('created_at', function (Tag $tag) {
                return $tag->created_at->format('Y-m-d');
            })
            ->editColumn('status', function (Tag $tag) {
                return view('dashboard.admin.tags.data_table.types', compact('tag'));
            })
            ->addColumn('actions', function (Tag $tag) {
                return view('dashboard.admin.tags.data_table.actions', compact('tag'));
            })
            ->rawColumns([ 'record_select','actions'])
            ->toJson();
        }
        return view('dashboard.admin.tags.index');
    }





    public function store($request) {
        try{
    //         $validator = Validator::make($request->all(),
    //         ['name' => 'required|min:3|max:250|regex:/^([a-zA-Z]+)(\s[a-zA-Z]+)*$/'],
    //         [
    //             'name.required'   => trans('Admin\validation.required'),
    //             'name.min'        => trans('Admin\validation.min'),
    //             'name.regex'      => trans('Admin\validation.regex'),
    //         ]);
    //         if ($validator->fails())
    //         {
    //             // return response()->json(['message'=>$validator->errors()->first()]);
    //             $error = array('message' => $validator->errors()->first(), 'title' =>__('error'));
    //                 return response()->json($error);
    //          //    return response()->json(['error'=>'error']);
    //         }
    //         // $validator = Validator::make($request->validated());
    //         // if ($validator->fails())
    //         // {
    //         //     // $message = array('message' => 'error', 'title' =>__('error'));
    //         //     // return response()->json($message);
    //         //     return response()->json(['status'=>$validator->errors()->first()]);
    //         // }
    //         // $requestData = $request->validated();
    //         $tagId = $request->id;
    //         $tag   =  Tag::updateOrCreate(
    //                     [ 'id' => $tagId ],
    //                     [ 'name' => $request->name, ]
    //                    );
    //                     // Toastr::message('message', 'level', 'title');
    //                     // toastr()->success(__('Admin/site.added_successfully'));

    //                     // return Response()->json($tag);
    //                     // if($tag){

    //                         $message = array('message' => 'Success!', 'title' =>__('Admin/site.added_successfully'));
    //                         return response()->json($message);

    //                     // }
    //                     // else
    //                     // {
    //                     //     $error = array('message' => 'error', 'title' =>__('error'));
    //                     //     return response()->json($error);
    //                     //     return $validator->errors()->all();
    //                     // }
            $requestData = $request->validated();
            Tag::create($requestData);
            toastr()->success(__('Admin/site.added_successfully'));
            return redirect()->route('tags.data');
            // return response()->json(toastr()->success(__('Admin/site.added_successfully')));

         } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
         }
    }
    public function update($request,$id) {
        try{
            $tagID = Crypt::decrypt($id);
            $tag=Tag::findorfail($tagID);
            $requestData = $request->validated();
            // $requestData['status'] = $request->status;
            $tag->update($requestData);
            toastr()->success( __('Admin/site.updated_successfully'));
            return redirect()->route('tags.data');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function destroy($id) {
        try{
            $tagID = Crypt::decrypt($id);
            $tag=Tag::findorfail($tagID);
            $tag->delete();
            toastr()->error(__('Admin/site.deleted_successfully'));
            return redirect()->route('tags.data');
        } catch (\Exception $e) {
           return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    public function bulkDelete($request)
    {
        if($request->delete_select_id){
                $delete_select_id = explode(",",$request->delete_select_id);
                foreach($delete_select_id as $tags_ids){
                    $blog = Tag::findorfail($tags_ids);
                }
        }else{
            toastr()->error(__('Admin/site.no_data_found'));
            return redirect()->route('tags.data');
        }
        Tag::destroy( $delete_select_id );
        toastr()->error(__('Admin/site.deleted_successfully'));
        return redirect()->route('tags.data');
    }// end of bulkDelete

}
