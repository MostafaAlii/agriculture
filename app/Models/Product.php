<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model {
    use HasFactory, Translatable, SoftDeletes;
    const PENDING = 0, REJECT = 2, ACTIVE = 1;
    protected $table = "products";
    protected $guarded = [];
    protected $with=['translations'];
    protected $slugAttribute = ['name'];
    public $translatedAttributes=['name','description', 'slug', 'other_data'];
    public $timestamps = true;

    protected $hidden = ['pivot'];

    protected $casts = [
        'manage_stock' => 'boolean',
        'in_stock' => 'boolean',
        'deleted_at' => 'datetime:Y/m/d',
    ];


    protected $dates = [
        'special_price_start',
        'special_price_end',
        'start_date',
        'end_date',
        'deleted_at',
    ];

    public function farmer(): BelongsTo {
        return $this->belongsTo(Farmer::class)->withDefault();
    }

    public function categories(): BelongsToMany {
        return $this->belongsToMany(Category::class, 'product_categories');
    }

    public function tags(): BelongsToMany {
        return $this->belongsToMany(Tag::class, 'product_tags');
    }

    public function units(): BelongsToMany {
        return $this->belongsToMany(Unit::class, 'product_unit');
    }

    // Product Has Many Options ::
    public function options(): HasMany {
        return $this->hasMany(Option::class);
    }

    public function image(): MorphOne {
        return $this->morphOne(Image::class, 'imageable');
    }

    public function comments() {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function scopeProductWithOutTrashed($query) {
        return $query->whereNull('deleted_at')->get();
    }

    public function scopeProductTrashed($query) {
        return $query->onlyTrashed()->get();
    }

    /*************************************************************************************** */
    // Vendor Rating Product
    public function ratings(): MorphToMany {
        return $this->morphToMany(User::class, 'rateable', 'ratings')->withPivot('rating');
   }
/*************************************************************************************** */
    // rating for each product
    public function scopeProductRate(){
        //product total rate
        if($this->ratings->count()){
            $productSum = $this->ratings->sum(function($item){ // $item is related to the guardTable (User or Other)
                return $item->pivot->rating;
            });
            $avg = 10*($productSum / $this->ratings->count());
        }else{
            $avg=0;
        }
        return $avg;
    }
}
