<?php

namespace App\Http\Livewire\Front\Farmer;

use App\Models\Category;
use App\Models\Farmer;
use App\Models\Image;
use App\Models\Product;
use App\Models\Tag;
use App\Models\Unit;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use App\Traits\HasImage;
class FarmerAddProductComponent extends Component
{
    use  WithFileUploads;
    public $is_qty;
    public $newimage;
    public $product_name;
    public $slug;
    public $cat=[];
    public $tag=[];
    public $status=0;
    public $desc;
    public $unit;
    public $price;
    public $qty;

    public function generateslug(){
        $this->slug = Str::slug($this->product_name,'-');
     }
     public function mount(){
        $this->slug           = Str::slug($this->product_name,'-');
        $this->categories     = Category::select('id')->get();
        $this->tags           = Tag::select('id')->get();
        $this->units          = Unit::where('visibility','1')->select('id')->get();
    }
    // real time validation----------------------------------------------------------------------------
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, [
            'newimage'       =>'required|image|mimes:jpeg,png,jpg|max:2048',
            'product_name'   =>'required|min:3|max:100',
            'cat'            =>'required|exists:categories,id|array',
            'tag'            =>'required|exists:tags,id|array',
            'unit'           =>'required|exists:units,id|',
            'price'          =>'required|numeric|min:1|digits_between:1,12|max:9999999999',
            'desc'           =>'sometimes|string|nullable|min:10|max:500',
        ]);
        if($this->is_qty){
            $this->validateOnly($propertyName, [
                'qty'   =>'required|numeric|min:1|max:9999999999',
               ]);
        }
    }
    // end real time validation-

    public function store(){
        DB::beginTransaction();
        try
        {
            $validateData = $this->validate([
                'newimage'       =>'required|image|mimes:jpeg,png,jpg|max:2048',
                'product_name'   =>'required|min:3|max:100',
                'cat'            =>'required|exists:categories,id|array',
                'tag'            =>'required|exists:tags,id|array',
                'unit'           =>'required|exists:units,id|',
                'price'          =>'required|numeric|min:1|digits_between:1,12|max:9999999999',
                'desc'           =>'sometimes|string|nullable|min:10|regex:/^[A-Za-z-أ-ي-pL\s\-]+$/u|max:500',
            ]);
                if($this->is_qty ){
                    $this->validate([
                        'qty' =>'required|numeric|min:1|max:9999999999',
                        ]);
                $product = new Product();
                $product->name           = $this->product_name;
                $product->farmer_id      = Auth::guard('web')->user()->id;
                $product->description    = $this->desc;
                $product->status         = $this->status;
                $product->is_qty         = $this->is_qty ? 1:0;
                $product->qty            = $this->qty;
                $product->save();
                $product->categories()->attach($this->cat);
                $product->tags()->attach($this->tag);
                $product->units()->syncWithPivotValues([$this->unit],['price'=>$this->price]);
                $product->save();
                if($this->newimage){
                    // $image = $this->newimage->extension();
                    // $name  = $this->slug;
                    // $filename = $name. '.' . $image;
                    $filename = 'product-'.time().Str::slug($this->product_name) . $this->newimage->hashName();
                    $Image = new Image();
                    $Image->filename = 'products/' . $filename;
                    $Image->imageable_id = $product->id;
                    $Image->imageable_type = 'App\Models\Product';
                    $Image->save();
                    $this->newimage->storeAs('products',$filename,'public');
                }
                DB::commit();
                session()->flash('Add',__('Admin/products.product_store_successfully'));
                return redirect()->route('farmer.product');
            }
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