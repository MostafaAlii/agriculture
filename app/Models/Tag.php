<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tag extends Model {
    use HasFactory, Translatable;
    protected $table = "tags";
    protected $guarded = [];
    protected $with = ['translations'];
    public $translatedAttributes = ['name'];

    protected $hidden = ['pivot'];
    
    public $timestamps = true;

    public function blogs(): BelongsToMany {
        return $this->belongsToMany(Blog::class, 'blog_tags'); //blog_categories
    }

    public function products(): BelongsToMany {
        return $this->belongsToMany(Product::class, 'product_tags'); 
    }
}
