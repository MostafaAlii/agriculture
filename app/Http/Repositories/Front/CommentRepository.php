<?php
namespace  App\Http\Repositories\Front;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\RedirectResponse;
use App\Http\Interfaces\Front\CommentInterface;

class CommentRepository implements CommentInterface{


    public function store_blog($blog,$request,$commentable_type='App\Models\Blog'): RedirectResponse {

        try{
            $data = $request->validated();

            if(Auth::guard('vendor')->user()){
                $name=Auth::guard('vendor')->user()->firstname;
                $email=Auth::guard('vendor')->user()->email;
                $image=Auth::guard('vendor')->user()->image->filename;
            }
            if(Auth::guard('web')->user()){
                $name=Auth::guard('web')->user()->firstname;
                $email=Auth::guard('web')->user()->email;
                $image=Auth::guard('web')->user()->image->filename;
            }
            if(Auth::guard('admin')->user()){
                $name=Auth::guard('admin')->user()->firstname;
                $email=Auth::guard('admin')->user()->email;
                $image=Auth::guard('admin')->user()->image->filename;
            }

            $comment = new Comment();
            ($request->from=='replay')?$comment->parent_id=$request->comment_id:'';
            $comment->commentable_id    = $blog->id;
            $comment->commentable_type  = $commentable_type;
            $comment->name              = $name;
            $comment->email             = $email;
            $comment->image             = $image;
            $comment->comment           = $data['comment'];
            $comment->save();


            return redirect()->back()->with(
                [
                    'success'       => trans('Website/comments.add_done'),
                    'div_active'    => 'allow',
                ]
            );

         } catch (\Exception $ex) {
            return redirect()->back()->withErrors(['error'=> __('Website/comments.error')]);
         }
    }


    public function store_product($product,$request): RedirectResponse {
        return $this->store_blog($product,$request,'App\Models\Product');
    }

    public function destroy($comment): RedirectResponse
    {
        try{
            $comment->delete();
            return redirect()->back()->withErrors(['error'=> __('Website/comments.delete_done')]);
            return back();
        }catch (\Exception $ex) {
            return redirect()->back()->withErrors(['error'=> __('Website/comments.delete_error')]);
         }
    }
}
