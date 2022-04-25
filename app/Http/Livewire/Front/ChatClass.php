<?php

namespace App\Http\Livewire\Front;

use App\Models\Chat;
use App\Models\Farmer;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class ChatClass extends Component
{

    public $messageText;
    public $guard_id ;
    
    public function render()
    {
     //  dd('ddddd');
        if(isset(Auth::guard('vendor')->user()->id)){
            $user_id=Auth::guard('vendor')->user()->id;
            $login_user = User::findOrfail($user_id);
            $title='الفلاحين';
            $type='Farmer';
            $all=Farmer::get();
            $model='App\Models\Farmer';

            
        }else{
            $user_id=Auth::user()->id;
            $login_user = Farmer::findOrfail($user_id);
            $title='التجار';
            $type='User';
            $all=User::get();
            $model='App\Models\User';
            
        }
        
        //لو اللى داخل فلاح
        //هشوف الرسائل اللى هو بعتها
        $v_ids1= Chat::where('email',$login_user->email)->groupBy('chatable_id')->pluck('chatable_id');
        //وهشوف الرسائل اللى التجار بعتوهم
        $v_ids2= $login_user->chats()->orderby('id','desc')->pluck('chatable_id');

        $v_ids = $v_ids1->merge($v_ids2)->sortBy('id');
        
        $live_chat= $model::select('*')->whereIn('id',$v_ids)->get();
       
        //dd($live_chat);

        //$messages= $login_user->chats()->orderby('id','desc')->get();
        $messages=[];
       return view('livewire.front.chat', compact('messages','all','title','type','live_chat'))->layout('front.layouts.master3');
    }

    public function sendMessage()
    {
        // return 'ddddddddd';
 //        dd($this->guard_id);

        if(Auth::guard('vendor')->user()){ //vendor
            $name=Auth::guard('vendor')->user()->firstname;
            $email=Auth::guard('vendor')->user()->email;
            $image=Auth::guard('vendor')->user()->image->filename;
            $model='App\Models\Farmer';
        }
        if(Auth::guard('web')->user()){//farmer
            $name=Auth::guard('web')->user()->firstname;
            $email=Auth::guard('web')->user()->email;
            $image=Auth::guard('web')->user()->image->filename;
            $model='App\Models\User';
        }
       // dd($chatable_id);
        
        Chat::create([
            // 'chatable_id' => $this->guard_id, //this will read correct only when i type into input by myself
            'chatable_id' => 1,
            'chatable_type' => $model,
            'name' => $name,
            'email' => $email,
            'image' => $image,
            'message_text' => $this->messageText,
        ]);

        $this->reset('messageText');
        // $this->reset('guard_id');
    }

    public function show_single_chat($id,$guard)
    {
        //in farmer page i will send vendeor id and User as guard
        
       // return $guard;
        // $model="App\Models\\".$guard;
        // $login_user = $model::findOrfail($id);
        // $title='الفلاحين';
        // $type='Farmer';
        
        if($guard=='User'){
            $search_id=Auth::guard('web')->user()->id;

            $f=Farmer::find($search_id);
            $v= User::find($id);
        
        }elseif($guard=='Farmer'){
            $search_id=Auth::guard('vendor')->user()->id;

            $f=Farmer::find($id);
            $v= User::find($search_id);
        }

        
        $farmer_msg= $v->chats()->where('email',$f->email)->orderby('id','desc')->get();
        $vendor_msg= $f->chats()->where('email',$v->email)->orderby('id','desc')->get();

        $messages = $farmer_msg->merge($vendor_msg)->sortBy('id');

       return view('livewire.front.single_chat',compact('messages','id'))->layout('front.layouts.master3');
    }

}