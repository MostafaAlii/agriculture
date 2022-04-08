<?php

namespace App\Http\Livewire\Front\Farmer;

use App\Models\Area;
use App\Models\Farmer;
use App\Models\Image;
use App\Models\Province;
use App\Models\State;
use App\Models\Village;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class FarmerEditProfileComponent extends Component
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
            'phone'           => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:11|unique:farmers,id,' . Auth::guard('web')->user()->id,
            'email'           => 'required|email|unique:farmers,id,' . Auth::guard('web')->user()->id,
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
        $farmer = Farmer::findOrFail(Auth::guard('web')->user()->id);
        $this->firstname     = $farmer->firstname ;
        $this->lastname      = $farmer->lastname ;
        $this->email         = $farmer->email ;
        $this->phone         = $farmer->phone ;
        $this->address1      = $farmer->address1 ;
        $this->address2      = $farmer->address2 ;
        $this->country_id    = $farmer->country_id ;
        $this->country_name  = $farmer->country->name ;
        $this->province_id   = $farmer->province_id ;
        $this->province_name = $farmer->province->name ;
        $this->area_id       = $farmer->area_id ;
        $this->area_name     = $farmer->area->name ;
        $this->state_id      = $farmer->state_id ;
        $this->state_name    = $farmer->state->name ;
        $this->village_id    = $farmer->village_id ;
        $this->village_name  = $farmer->village->name ;
        $this->department_id = $farmer->department_id ;
        $this->birthdate     = $farmer->birthdate ;
        $this->image         = $farmer->image->filename ;
    }

    public function updateProfile()
    {
        $this->validate([
            'firstname'       => 'required|min:3|string|regex:/^[A-Za-z-أ-ي-pL\s\-]+$/u',
            'lastname'        => 'required|min:3|string|regex:/^[A-Za-z-أ-ي-pL\s\-]+$/u',
            'phone'           => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:11|unique:farmers,id,' . Auth::guard('web')->user()->id,
            'email'           => 'required|email|unique:farmers,id,' . Auth::guard('web')->user()->id,
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
        $farmer = Farmer::findOrFail(Auth::guard('web')->user()->id);
        $farmer->firstname        = $this->firstname;
        $farmer->lastname         = $this->lastname;
        $farmer->phone            = $this->phone;
        $farmer->address1         = $this->address1;
        $farmer->address2         = $this->address2;
        $farmer->country_id       = $this->country_id;
        $farmer->province_id      = $this->province_id;
        $farmer->area_id          = $this->area_id;
        $farmer->state_id         = $this->state_id ;
        $farmer->village_id       = $this->village_id;
        $farmer->department_id    = $this->department_id;
        $farmer->birthdate        = $this->birthdate;
        $farmer->save();
        if($this->newimage){
            if($this->image){
                $this->deleteImage('upload_image','/farmers/' . Auth::guard('web')->user()->image->filename,Auth::guard('web')->user()->id);
            }
            $image = $this->newimage->extension();
            $name  = Str::slug($this->firstname . $this->lastname,'-');
            $filename = $name. '.' . $image;
            $Image = new Image();
            $Image->filename = $filename;
            $Image->imageable_id = Auth::guard('web')->user()->id;
            $Image->imageable_type = 'App\Models\Farmer';
            $Image->save();
            $this->newimage->storeAs('farmers',$filename,'upload_image');
        }
        session()->flash('message',__("Website/home.profileupdatesms"));
        return redirect()->route('farmer.ownprofile');
    }
    public function deleteImage($disk,$path,$id)
    {
        Storage::disk($disk)->delete($path);
        Image::where('imageable_id',$id)->delete();
    }
    public function render()
    {
        return view('livewire.front.farmer.farmer-edit-profile-component',[
            'provinces' => Province::where('country_id',$this->country_id)->get(),
            'areas'     => Area::where('province_id',$this->province_id)->get(),
            'states'    => State::where('area_id',$this->area_id)->get(),
            'villages'  => Village::where('state_id',$this->state_id)->get(),
        ])->layout('front.layouts.master2');
    }
}
