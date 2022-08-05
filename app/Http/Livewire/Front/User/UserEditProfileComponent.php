<?php

namespace App\Http\Livewire\Front\User;

use App\Models\Area;
use App\Models\Image;
use App\Models\Province;
use App\Models\State;
use App\Models\User;
use App\Models\Village;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
class UserEditProfileComponent extends Component
{
    use WithFileUploads;
    public $firstname;
    public $lastname;
    public $email;
    public $phone;
    public $address1;
    public $address2;
    public $country_id;
    public $country_name;
    public $province_id;
    public $province_name;
    public $area_id;
    public $area_name;
    public $state_id;
    public $state_name;
    public $village_id;
    public $village_name;
    public $department_id;
    public $birthdate;
    public $image;
    public $newimage;

    public function updated($fields){
        $this->validateOnly($fields,[
            'firstname'       => 'required|min:3|string|regex:/^[A-Za-z-أ-ي-pL\s\-]+$/u',
            'lastname'        => 'required|min:3|string|regex:/^[A-Za-z-أ-ي-pL\s\-]+$/u',
            'phone'           => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:11|unique:users,id,' . Auth::guard('vendor')->user()->id,
            'email'           => 'required|email|unique:users,id,' . Auth::guard('vendor')->user()->id,
            'birthdate'       => 'before:today',
            'country_id'      => 'required',
            'province_id'     => 'required',
            'area_id'         => 'required',
            'state_id'        => 'required',
            'village_id'      => 'required',
            'department_id'   => 'required',
            'address1'        => 'required|regex:/^[A-Za-z-أ-ي-pL\s\-]+$/u',
            'address2'        => 'required|regex:/^[A-Za-z-أ-ي-pL\s\-]+$/u',

         ]);
    }
    public function mount()
    {
        $user = User::findOrFail(Auth::guard('vendor')->user()->id);
        $this->firstname     = $user->firstname ;
        $this->lastname      = $user->lastname ;
        $this->email         = $user->email ;
        $this->phone         = $user->phone ;
        $this->address1      = $user->address1 ;
        $this->address2      = $user->address2 ;
        $this->country_id    = $user->country_id ;
        $this->country_name  = $user->country->name ;
        $this->province_id   = $user->province_id ;
        $this->province_name = $user->province->name ;
        $this->area_id       = $user->area_id ;
        $this->area_name     = $user->area->name ;
        $this->state_id      = $user->state_id ;
        $this->state_name    = $user->state->name ;
        $this->village_id    = $user->village_id ;
        $this->village_name  = $user->village->name ;
        $this->department_id = $user->department_id ;
        $this->birthdate     = $user->birthdate ;
        $this->image         = $user->image->filename ;
    }

    public function updateProfile()
    {
        $this->validate([
            'firstname'       => 'required|min:3|string|regex:/^[A-Za-z-أ-ي-pL\s\-]+$/u',
            'lastname'        => 'required|min:3|string|regex:/^[A-Za-z-أ-ي-pL\s\-]+$/u',
            'phone'           => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:11|unique:users,id,' . Auth::guard('vendor')->user()->id,
            'email'           => 'required|email|unique:users,id,' . Auth::guard('vendor')->user()->id,
            'birthdate'       => 'before:today',
            'country_id'      => 'required',
            'province_id'     => 'required',
            'area_id'         => 'required',
            'state_id'        => 'required',
            'village_id'      => 'required',
            'department_id'   => 'required',
            'address1'        => 'required|regex:/^[A-Za-z-أ-ي-pL\s\-]+$/u',
            'address2'        => 'required|regex:/^[A-Za-z-أ-ي-pL\s\-]+$/u',
           ]);
        $user = User::findOrFail(Auth::guard('vendor')->user()->id);
        $user->firstname        = $this->firstname;
        $user->lastname         = $this->lastname;
        $user->phone            = $this->phone;
        $user->address1         = $this->address1;
        $user->address2         = $this->address2;
        $user->country_id       = $this->country_id;
        $user->province_id      = $this->province_id;
        $user->area_id          = $this->area_id;
        $user->state_id         = $this->state_id ;
        $user->village_id       = $this->village_id;
        $user->department_id    = $this->department_id;
        $user->birthdate        = $this->birthdate;
        $user->save();
        if($this->newimage){
            if($this->image){
                $this->deleteImage('upload_image','/users/' . Auth::guard('vendor')->user()->image->filename,Auth::guard('vendor')->user()->id);
            }
            $image = $this->newimage->extension();
            $name  = Str::slug($this->firstname . $this->lastname,'-');
            $filename = $name. '.' . $image;
            $Image = new Image();
            $Image->filename = $filename;
            $Image->imageable_id = Auth::guard('vendor')->user()->id;
            $Image->imageable_type = 'App\Models\User';
            $Image->save();
            $this->newimage->storeAs('users',$filename,'upload_image');
        }
        session()->flash('message',__("Website/home.profileupdatesms"));
        return redirect()->route('user.ownprofile');
    }
    public function deleteImage($disk,$path,$id)
    {
        Storage::disk($disk)->delete($path);
        Image::where('imageable_id',$id)->delete();
    }
    public function render()
    {

        // return view('livewire.front.user.user-edit-profile-component')->layout('front.layouts.master2');
        return view('livewire.front.user.user-edit-profile-component',[
            'provinces' => Province::where('country_id',$this->country_id)->get(),
            'areas'     => Area::where('province_id',$this->province_id)->get(),
            'states'    => State::where('area_id',$this->area_id)->get(),
            'villages'  => Village::where('state_id',$this->state_id)->get(),
            // 'provinces' => Province::get(),
        ])->layout('front.layouts.master2');
    }
}
