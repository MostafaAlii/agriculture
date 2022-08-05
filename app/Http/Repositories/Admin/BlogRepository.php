<?php
namespace App\Http\Repositories\Admin;

use App\Models\Tag;
use App\Models\Blog;
use App\Models\Admin;
use App\Traits\UploadT;
use App\Models\Category;

use App\Models\Department;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use App\Http\Interfaces\Admin\BlogInterface;
use App\Models\BlogTranslation;

class BlogRepository implements BlogInterface {
    use UploadT;
    public function index() {
        return view('dashboard.admin.blogs.index');
    }

    public function data() {
        $blogs = Blog::get();
        return DataTables::of($blogs)
            ->addColumn('record_select', 'dashboard.admin.blogs.data_table.record_select')
            ->addIndexColumn()
            ->editColumn('created_at', function (Blog $blog) {
                return $blog->created_at->format('Y-m-d');
            })
            // ->editColumn('title', function (Blog $blog) {
            //     return $blog->title;
            // })
            ->addColumn('image', function (Blog $blog) {
                return view('dashboard.admin.blogs.data_table.image', compact('blog'));
            })
            ->addColumn('admin', function (Blog $blog) {
                return $blog->admin->firstname??null;
            })
            ->addColumn('category_name', function (Blog $blog) {
                return view('dashboard.admin.blogs.data_table.related_category', compact('blog'));
             })
            ->addColumn('type', function (Blog $blog) {
                return $blog->admin->type??null;
            })
            ->addColumn('actions', 'dashboard.admin.blogs.data_table.actions')
            ->rawColumns([ 'record_select','actions'])
            ->toJson();
    }


    public function create() {
        $data['admins']        = Admin::select('id','firstname','lastname')->without('created_at', 'updated_at')->get();
        $data['tags']          = Tag::select('id')->without('created_at', 'updated_at')->get();
        $data['categories']    = Category::select('id')->without('created_at', 'updated_at')->get();
        return view('dashboard.admin.blogs.create', $data);
    }

    public function store($request) {
//dd($request->all());
        DB::beginTransaction();
        try{

            $requestData = $request->validated();

           // Blog::create($requestData);
           // $blog = Blog::latest()->first();

            $blog = new Blog;
            $blog ->admin_id = $request->admin_id;

            $blog->title=$request->title;
            $blog->body=$request->body;
            $blog->save();

            $this->addImageblog($request, 'image' , 'blogs' , 'upload_image',$blog->id, 'App\Models\Blog');

             // Attach Category ::
             $blog->categories()->attach($request->categories);

             // Attach Tag ::
             $blog->tags()->attach($request->tags);

            DB::commit();
            toastr()->success(__('Admin/site.added_successfully'));
            return redirect()->route('blogs.index');
         } catch (\Exception $e) {
             DB::rollBack();
            // dd($e->getMessage());
             toastr()->error(__('Admin/site.sorry'));
             return redirect()->back();
         }
    }

    public function edit($id) {
        $blogID = Crypt::decrypt($id);
        $data['blog']       = Blog::findorfail($blogID);
        $data['admins']     = Admin::select('id','firstname','lastname')->without('created_at', 'updated_at')->get();
        $data['tags']       = Tag::select('id')->without('created_at', 'updated_at')->get();
        $data['categories'] = Category::select('id')->without('created_at', 'updated_at')->get();
        // Admin::where()
        return view('dashboard.admin.blogs.edit', $data);
    }

    public function update($request,$id) {
        try{
            DB::beginTransaction();
            $blogID = Crypt::decrypt($id);


            $blog=Blog::findorfail($blogID);

             // $requestData = $request->validated();
            // $blog->update($requestData);

            $blog ->admin_id = $request->admin_id;
            $blog->save();

            $blog->title=$request->title;
            $blog->body=$request->body;
            $blog->save();


            if($request->image){
                $this->deleteImage('upload_image','/blogs/' . $blog->image->filename,$blog->id);
            }
            $this->addImageblog($request, 'image' , 'blogs' , 'upload_image',$blog->id, 'App\Models\Blog');

             // sync Categories ::
             $blog->categories()->sync($request->categories);
             $blog->tags()->sync($request->tags);


            DB::commit();
            toastr()->success( __('Admin/site.updated_successfully'));
            return redirect()->route('blogs.index');
        } catch (\Exception $e) {
            DB::rollBack();
            toastr()->error(__('Admin/site.sorry'));
            return redirect()->back();
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
            toastr()->error(__('Admin/site.sorry'));
            return redirect()->back();
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
