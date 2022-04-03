<?php
namespace  App\Http\Repositories\Front;
use App\Models\Comment;
use App\Http\Interfaces\Front\CommentInterface;

use Illuminate\Http\RedirectResponse;

class CommentRepository implements CommentInterface{

    
    public function store($blog,$request): RedirectResponse {
     
        try{
            $data = $request->validated();
            $comment = new Comment();
    
            ($request->from=='replay')?$comment->parent_id=$request->comment_id:'';
            $comment->blog_id = $blog->id;
            $comment->author  = $data['author'];
            $comment->text    = $data['text'];
            $comment->save();
    
            
            // toastr()->success(__('Admin/attributes.added_done'));
            toastr()->success('تم نشر التعليق بنجاح');
            return redirect()->back();   
         } catch (\Exception $ex) {
            toastr()->error('حدث خطا اثناء اضافه التعليق');
            return redirect()->back();
         }
    }

    public function destroy($comment): RedirectResponse
    {
        $comment->delete();
        return back();
    }
}
