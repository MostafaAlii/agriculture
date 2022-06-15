<?php
namespace App\Models;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;

class Category extends Model implements TranslatableContract{
    
    use HasFactory,Translatable,SoftDeletes;
    protected $table = "categories";
    protected $fillable = ['parent_id','department_id'];

    protected $with=['translations'];
    public $translatedAttributes=['name','description','keyword','slug'];

    public $timestamps = true;

    protected $hidden = ['pivot'];
    
    public function childs() {
        return $this->hasMany('App\Models\Category','parent_id','id') ;
    }

 
    public function products(): BelongsToMany {
        return $this->belongsToMany(Product::class, 'product_categories'); //product_categories
    }

    public function blogs(): BelongsToMany {
        return $this->belongsToMany(Blog::class, 'blog_categories'); //blog_categories
    }

    public function Category_department():BelongsTo{
        return $this->belongsTo('App\Models\Department','department_id');
    }

    public function scopeParentCategory() {
        return $this->whereNull('parent_id')->get();
    }
    public function scopeChildCategory() {
        return $this->whereNotNull('parent_id')->get();
    }


    //-------------this will be used in delete confirmation pop up ------------------------------------
    //-------------check if there are related models  linked with this  model or no -------------------
    public function related(){

        $found_or_no=0;

        $output='<center>';
        if ($this->products()->count()> 0){
            $found_or_no++;
            // $output.='<h3>'. __('Admin\departments.relate_with_users').'</h3>';
            $output.='<h3>يوجد منتجات فى هذا القسم</h3>';
        }
        if (Category::where('parent_id', $this->id)->count() > 0){
            $found_or_no++;
            $output.= '<h3>'. __('Admin\departments.relate_with_category').'</h3>';
        }
        $output.= '</center>';
        
        if($found_or_no>0){
            $output.= '<center><h3 style="color:red">'. __('Admin\departments.confirm_deletion').'</h3></center>';
        }else{
            $output.= '<center><h3 style="color:red">'. __('Admin/site.warning').'</h3></center>';
        }
        echo $output;
    }
    //---------------------------------------------------------------------------------------------------


    
}
