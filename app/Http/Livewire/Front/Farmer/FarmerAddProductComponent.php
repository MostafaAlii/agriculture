<?php

namespace App\Http\Livewire\Front\Farmer;

use App\Models\Category;
use App\Models\Farmer;
use App\Models\Image;
use App\Models\Product;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
class FarmerAddProductComponent extends Component
{
    use WithFileUploads;
    public $image;
    public $product_name;
    public $slug;
    public $categories=[];
    public $tags=[];
    public $price;
    public $status=0;
    public $desc;
    public $location;
    public function generateslug(){
        $this->slug = Str::slug($this->product_name,'-');
     }
     public function mount(){
        $this->categories = Category::select('id')->get();
        $this->tags       =  Tag::select('id')->get();;
    }
    // real time validation----------------------------------------------------------------------------
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, [
            'image'          =>'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'product_name'   =>'required|min:3',
            // 'slug'           =>'required|unique:products,slug',
            'categories'     =>'required',
            'tags'           =>'required',
            'price'          =>'required|numeric|min:2',
            'desc'           =>'required|min:10',
            'location'       =>'required|min:10',
        ]);
    }
    // end real time validation-

    public function store(){
        // DB::beginTransaction();
        // try{
        $validateData = $this->validate([
            'image'          =>'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'product_name'   =>'required|min:3',
            // 'slug'           =>'required|unique:products,slug',
            'categories'     =>'required',
            'tags'           =>'required',
            'price'          =>'required|numeric|min:2',
            'desc'           =>'required|min:10',
            'location'       =>'required|min:10',
          ]);
        $product = new Product();
        $product->name           = $this->product_name;
        $product->slug           = $this->slug;
        $product->farmer_id      = Auth::user()->id;
        $product->price          = $this->price;
        $product->description    = $this->desc;
        $product->status         = $this->status;
        $product->product_location = $this->location;
        $product->save();
        $product->categories()->attach($this->categories);
        $product->tags()->attach($this->tags);
        $product->save();

        $image = $this->image->extension();
        $name  = $this->slug;
        $filename = $name. '.' . $image;
        $Image = new Image();
        $Image->filename = $filename;
        $Image->imageable_id = $product->id;
        $Image->imageable_type = 'App\Models\Product';
        $Image->save();
        $this->image->storeAs('products',$filename,'upload_image');

        // DB::commit();
        session()->flash('Add','Product added successfully');
        return redirect()->route('farmer.product');
    // } catch (\Exception $e) {
    //     DB::rollBack();
    //     session()->flash('error',__('Admin/site.sorry'));
    //     return redirect()->back();
    //  }
    }
    public function render()
    {
        $data = [];
        // $data['farmers']        =       Farmer::select('id', 'firstname', 'lastname')->get();
        $data['tags']           =       Tag::select('id')->without('created_at', 'updated_at')->get();
        $data['categories']     =       Category::select('id')->without('created_at', 'updated_at')->get();
        return view('livewire.front.farmer.farmer-add-product-component',$data)->layout('front.layouts.master2');
    }
}
