<?php
namespace App\Http\Repositories\Admin;
use App\Models\{Tag, Blog, Admin, Category,Department,BlogTranslation};
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\{DB, Crypt};
use App\Http\Interfaces\Admin\BlogInterface;
use Illuminate\Support\Str;
use App\Traits\HasImage;
class BlogRepository implements BlogInterface {
    use HasImage;
    public function index() {
        return view('dashboard.admin.blogs.index');
    }

    public function data() {
        $blogs = Blog::orderBy('created_at', 'desc')->get();
        return DataTables::of($blogs)
            ->addColumn('record_select', 'dashboard.admin.blogs.data_table.record_select')
            ->addIndexColumn()
            ->editColumn('created_at', function (Blog $blog) {
                return $blog->created_at->format('Y-m-d');
            })
            ->editColumn('body', function (Blog $blog) {
                return Str::limit($blog->body, 50);
            })
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
        DB::beginTransaction();
        try{
            $requestData = $request->validated();
            $blog = new Blog;
            $blog ->admin_id = $request->admin_id;
            $blog->title=$request->title;
            $blog->body=$request->body;
            $blog->save();
            if($request->hasFile('image')) {
                $image = $request->file('image');
                $name = 'blog-'.time().Str::slug($request->input('title'));
                $filename = $name .'.'.$image->getClientOriginalName();
                $blog->storeImage($image->storeAs('blogs', $filename, 'public'));
           }
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
            $blog ->admin_id = $request->admin_id;
            $blog->save();
            $blog->title=$request->title;
            $blog->body=$request->body;
            $blog->save();
            if($request->hasFile('image')) {
                $image = $request->file('image');
                $name = 'blog-'.time().Str::slug($request->input('title'));
                $filename = $name .'.'.$image->getClientOriginalName();
                $blog->updateImage($image->storeAs('blogs', $filename, 'public'));
           }

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
            $blog->delete();
            toastr()->error(__('Admin/site.deleted_successfully'));
            return redirect()->route('blogs.index');
        } catch (\Exception $e) {
            toastr()->error(__('Admin/site.sorry'));
            return redirect()->back();
        }
    }

    public function bulkDelete($request) {
        if($request->delete_select_id){
                $delete_select_id = explode(",",$request->delete_select_id);
                foreach($delete_select_id as $blogs_ids){
                    $blog = Blog::findorfail($blogs_ids);
                    if($blog->image && $blog->image->filename != 'default_blog.jpg'){
                        $old_photo = $blog->image->filename;
                        $blog->deleteImage();
                    }
                }
        }else{
            toastr()->error(__('Admin/site.no_data_found'));
            return redirect()->route('blogs.index');
        }
        Blog::destroy( $delete_select_id );
        toastr()->error(__('Admin/site.deleted_successfully'));
        return redirect()->route('blogs.index');
    }
}