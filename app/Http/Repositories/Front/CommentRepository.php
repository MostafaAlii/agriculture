<?php
namespace  App\Http\Repositories\Front;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\RedirectResponse;
use App\Http\Interfaces\Front\CommentInterface;

class CommentRepository implements CommentInterface{

    
    public function store($blog,$request): RedirectResponse {
     
        try{
            $data = $request->validated();

            // ($request->from=='replay')?$parent_id=$request->comment_id:$parent_id='';
            // $blog->comments()->create([

            //     'parent_id'     => $parent_id,
            //     'name'          => $data['name'],
            //     'email'         => $data['email'],
            //     'image'         => '',
            //     'comment'       => $data['comment'],
                
            // ]);
            
         
            if(Auth::guard('vendor')->user()){
                $name=Auth::guard('vendor')->user()->firstname;
                $email=Auth::guard('vendor')->user()->email;
                $image=Auth::guard('vendor')->user()->image->filename;
            }else{
                $name=Auth::guard('web')->user()->firstname;
                $email=Auth::guard('web')->user()->email;
                $image=Auth::guard('web')->user()->image->filename;
            }

            // dd($name.'   ,   '.$email);

            $comment = new Comment();
            ($request->from=='replay')?$comment->parent_id=$request->comment_id:'';
            $comment->commentable_id    = $blog->id;
            $comment->commentable_type  = 'App\Models\Blog';
            $comment->name              = $name;
            $comment->email             = $email;
            $comment->image             = $image;
            $comment->comment           = $data['comment'];
            $comment->save();
    
            
            return redirect()->back()->with(['success'=>__('website\comments.add_done')]);
 
         } catch (\Exception $ex) {
            return redirect()->back()->with(['error'=>__('website\comments.error')]);
         }
    }

    public function destroy($comment): RedirectResponse
    {
        $comment->delete();
        return back();
    }
}
