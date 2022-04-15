<?php

namespace App\Http\Livewire\Front\Farmer;

use Livewire\Component;
use App\Models\Category;
use App\Models\Farmer;
use App\Models\Image;
use App\Models\Product;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;

class FarmerEditProductComponent extends Component
{
    use WithFileUploads;

    public $product_id;
    public $newimage;
    public $image;
    public $product_name;
    public $slug;
    // public $oldcat=[];
    public $cat=[];
    public $tag=[];
    public $price;
    public $status=0;
    public $desc;
    // public $location;


    public function generateslug(){
        $this->slug = Str::slug($this->product_name,'-');
     }
     public function mount($product_id){
        $product = Product::where('id',$product_id)->first();
        $this->product_name =$product->name;
        $this->slug         =$product->slug;
        $this->price        =$product->price;
        $this->desc         =$product->description;
        $this->product_id   =$product->id;
        $this->image        =$product->image->filename;
        $this->cat          = $product->categories;
        $this->tag          = $product->tags;
        $this->categories     = Category::select('id')->get();
        $this->tags           = Tag::select('id')->get();
    }
    // real time validation----------------------------------------------------------------------------
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, [
            'newimage'       =>'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'product_name'   =>'required|min:3',
             'cat.*.name' => 'numeric|exists:categories,id',
            'cat'     =>'required|array|min:1',
            'tag'            =>'required',
            'price'          =>'required|numeric|min:2',
            'desc'           =>'required|min:10',
            // 'location'       =>'required|min:10',
        ]);
    }
    // end real time validation-

    public function updateProduct(){
        DB::beginTransaction();
        try{
        $validateData = $this->validate([
            'newimage'       =>'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'product_name'   =>'required|min:3',
            'cat'            =>'required',
            'tag'            =>'required',
            'price'          =>'required|numeric|min:2',
            'desc'           =>'required|min:10',
            // 'location'       =>'required|min:10',
          ]);
        $product = Product::findorfail($this->product_id);
        $product->name           = $this->product_name;
        $product->slug           = $this->slug;
        $product->farmer_id      = Auth::user()->id;
        $product->price          = $this->price;
        $product->description    = $this->desc;
        $product->status         = $this->status;
        // $product->product_location = $this->location;
        $product->save();

        $product->categories()->sync($this->cat);
        $product->tags()->sync($this->tag);
        $product->save();
        if($this->newimage){
            if($this->image){
                $this->deleteImage('upload_image','/products/' . $product->image->filename,$product->id);
            }
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
        session()->flash('Add',__('Admin/products.product_updated_successfully'));
        return redirect()->route('farmer.product');
    } catch (\Exception $e) {
        DB::rollBack();
        session()->flash('error',__('Admin/site.sorry'));
        return redirect()->back();
     }
    }
    public function deleteImage($disk,$path,$id)
    {
        Storage::disk($disk)->delete($path);
        Image::where('imageable_id',$id)->delete();
    }
    public function render()
    {
        return view('livewire.front.farmer.farmer-edit-product-component')->layout('front.layouts.master2');
    }
}
