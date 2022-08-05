<?php

namespace App\Http\Controllers\front;

use App\Models\Review;
use App\Http\Controllers\Controller;
use App\Http\Requests\Front\ReviewRequest;

class ReviewController extends Controller
{
    public function add(ReviewRequest $request)
    {
        //dd($request->all());
        try{
            $review=new Review;
            $review->name=$request->name;
            $review->email=$request->email;
            $review->message=$request->message;
            $review->show_or_hide='0';
            $review->save();
            
            return redirect()->back()->with(['review_success'=>__('Admin/about.add_done')]);   

        } catch (\Exception $ex) {
            return redirect()->back()->with(['review_success'=>__('Admin/about.add_wrong')]);   
         }
    }

 
}
