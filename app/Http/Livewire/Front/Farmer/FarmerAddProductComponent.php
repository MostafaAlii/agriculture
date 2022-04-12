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

    public $newimage;
    public $product_name;
    public $slug;
    public $cat=[];
    public $tag=[];
    public $price;
    public $status=0;
    public $desc;
    // public $location;


    public function generateslug(){
        $this->slug = Str::slug($this->product_name,'-');
     }
     public function mount(){
        $this->slug           = Str::slug($this->product_name,'-');
        $this->categories     = Category::select('id')->get();
        $this->tags           = Tag::select('id')->get();
    }
    // real time validation----------------------------------------------------------------------------
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, [
            'newimage'       =>'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'product_name'   =>'required|min:3',
            'cat'     =>'required',
            'tag'           =>'required',
            'price'          =>'required|numeric|min:2',
            'desc'           =>'required|min:10',
            // 'location'       =>'required|min:10',
        ]);
    }
    // end real time validation-

    public function store(){
        DB::beginTransaction();
        try{
        $validateData = $this->validate([
            'newimage'       =>'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'product_name'   =>'required|min:3',
            'cat'     =>'required',
            'tag'           =>'required',
            'price'          =>'required|numeric|min:2',
            'desc'           =>'required|min:10',
            // 'location'       =>'required|min:10',
          ]);
        $product = new Product();
        $product->name           = $this->product_name;
        $product->slug           = $this->slug;
        $product->farmer_id      = Auth::user()->id;
        $product->price          = $this->price;
        $product->description    = $this->desc;
        $product->status         = $this->status;
        // $product->product_location = $this->location;
        $product->save();

        $product->categories()->attach($this->cat);
        $product->tags()->attach($this->tag);
        $product->save();
        if($this->newimage){
            $image = $this->newimage->extension();
            $name  = $this->slug;
            $filename = $name. '.' . $image;
            $Image = new Image();
            $Image->filename = $filename;
            $Image->imageable_id = $product->id;
            $Image->imageable_type = 'App\Models\Product';
            $Image->save();
            $this->newimage->storeAs('products',$filename,'upload_image');
        }
        DB::commit();
        session()->flash('Add',__('Admin/products.product_store_successfully'));
        return redirect()->route('farmer.product');
    } catch (\Exception $e) {
        DB::rollBack();
        session()->flash('error',__('Admin/site.sorry'));
        return redirect()->back();
     }
    }
    public function render()
    {

        return view('livewire.front.farmer.farmer-add-product-component')->layout('front.layouts.master2');
    }
}
