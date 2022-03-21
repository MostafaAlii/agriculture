<?php
namespace App\Http\Repositories\Admin;

use App\Http\Interfaces\Admin\BlogInterface;
use App\Models\Admin;
use App\Models\Blog;
use App\Traits\UploadT;
use Illuminate\Support\Facades\Crypt;

use App\Models\Department;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class BlogRepository implements BlogInterface {
    use UploadT;
    public function index() {
        return view('dashboard.admin.blogs.index');
    }

    public function data() {
        $blogs = Blog::select();
        return DataTables::of($blogs)
            ->addColumn('record_select', 'dashboard.admin.blogs.data_table.record_select')
            ->addIndexColumn()
            ->editColumn('created_at', function (Blog $blog) {
                return $blog->created_at->format('Y-m-d');
            })
            ->addColumn('image', function (Blog $blog) {
                return view('dashboard.admin.blogs.data_table.image', compact('blog'));
            })
            ->addColumn('admin', function (Blog $blog) {
                return $blog->admin->firstname??null;
            })
            ->addColumn('type', function (Blog $blog) {
                return $blog->admin->type??null;
            })
            ->addColumn('actions', 'dashboard.admin.blogs.data_table.actions')
            ->rawColumns([ 'record_select','actions'])
            ->toJson();
    }


    public function create() {
        return view('dashboard.admin.blogs.create');
    }

    public function store($request) {
        DB::beginTransaction();
        try{
            $requestData = $request->validated();
            Blog::create($requestData);
            $blog = Blog::latest()->first();
            $this->addImageblog($request, 'image' , 'blogs' , 'upload_image',$blog->id, 'App\Models\Blog');
            DB::commit();
            toastr()->success(__('Admin/site.added_successfully'));
            return redirect()->route('blogs.index');
         } catch (\Exception $e) {
             DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
         }
    }

    public function edit($id) {
        $blogID = Crypt::decrypt($id);
        $blog=Blog::findorfail($blogID);
        // Admin::where()
        return view('dashboard.admin.blogs.edit', compact('blog'));
    }

    public function update($request,$id) {
        try{
            DB::beginTransaction();
            $blogID = Crypt::decrypt($id);
            $blog=Blog::findorfail($blogID);
            $requestData = $request->validated();
            $blog->update($requestData);
            if($request->image){
                $this->deleteImage('upload_image','/blogs/' . $blog->image->filename,$blog->id);
            }
            $this->addImageblog($request, 'image' , 'blogs' , 'upload_image',$blog->id, 'App\Models\Blog');
            DB::commit();
            toastr()->success( __('Admin/site.updated_successfully'));
            return redirect()->route('blogs.index');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy($id) {
        try{
            $blogID = Crypt::decrypt($id);
            $blog=Blog::findorfail($blogID);
            $this->deleteImage('upload_image','/blogs/' . $blog->image->filename,$blog->id);
            $blog->delete();
            toastr()->error(__('Admin/site.deleted_successfully'));
            return redirect()->route('blogs.index');
        } catch (\Exception $e) {
           return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    public function bulkDelete($request)
    {
        if($request->delete_select_id){
                $delete_select_id = explode(",",$request->delete_select_id);
                foreach($delete_select_id as $blogs_ids){
                    $blog = Blog::findorfail($blogs_ids);
                    if($blog->image){
                        $this->deleteImage('upload_image','/blogs/' . $blog->image->filename,$blog->id);
                    }
                }
        }else{
            toastr()->error(__('Admin/site.no_data_found'));
            return redirect()->route('blogs.index');
        }
        Blog::destroy( $delete_select_id );
        toastr()->error(__('Admin/site.deleted_successfully'));
        return redirect()->route('blogs.index');
    }// end of bulkDelete
}
