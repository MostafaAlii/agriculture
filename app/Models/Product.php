<?php
namespace App\Models;
use App\Models\UnitTranslation;
use App\Observers\ProductObserver;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\{HasMany, MorphMany, MorphOne, BelongsTo, MorphToMany, BelongsToMany};
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Product extends Model {
    use HasFactory, Translatable, SoftDeletes;
    const PENDING = 1, ACTIVE = 2, IN_STOCK = 1;
    protected $table = "products";
    protected $guarded = [];
    protected $with=['translations','units'];
    protected $slugAttribute = ['name'];
    public $translatedAttributes=['name','description', 'reason', 'other_data'];
    public $timestamps = true;

    protected $hidden = ['pivot'];

    protected $casts = [
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
        return $this->belongsToMany(Unit::class, 'product_unit')->withPivot(['price']);
    }

    // Product Has Many Options ::
    public function options(): HasMany {
        return $this->hasMany(Option::class);
    }

    public function image(): MorphOne {
        return $this->morphOne(Image::class, 'imageable');
    }

    public function comments(): MorphMany {
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

    public function getStatusType() {
        switch ($this->status) {
            case 0 : $result = trans('Admin/products.pending') ; break;
            case 1 : $result = trans('Admin/products.active') ; break;
        }
        return $result;
    }

    public function scopeGetPrice(){
        return $this->units()->where('product_id', $this->id)->first()->pivot->price;
    }
    public function scopeGetUnit(){
        $ProductUnits = $this->units->pluck('id');
        $unit_id=$this->units()->whereIn('unit_id', $ProductUnits)->pluck('id')->first();
        return UnitTranslation::whereId($unit_id)->select('Name')->first();
    }

    protected static function boot() {
        parent::boot();
        Product::observe(ProductObserver::class);
    }
}
