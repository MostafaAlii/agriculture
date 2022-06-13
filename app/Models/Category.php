<?php
namespace App\Models;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;

class Category extends Model implements TranslatableContract{
    
    use HasFactory,Translatable,SoftDeletes;
    protected $table = "categories";
    protected $guarded = [];

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

    public function Category_department()
    {
        return $this->belongsTo('App\Models\Department','department_id') ;
    }

    public function scopeParentCategory() {
        return $this->whereNull('parent_id')->get();
    }
    public function scopeChildCategory() {
        return $this->whereNotNull('parent_id')->get();
    }
    
}
