<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model {
    use HasFactory, Translatable, SoftDeletes;
    protected $table = "products";
    protected $guarded = [];
    protected $with=['translations'];
    protected $slugAttribute = ['name'];
    public $translatedAttributes=['name','description'];
    public $timestamps = true;

    protected $hidden = ['pivot'];
    
    protected $casts = [
        'manage_stock' => 'boolean',
        'in_stock' => 'boolean',
        'status' => 'boolean',
    ];

    protected $dates = [
        'special_price_start',
        'special_price_end',
        //'start_date',
        //'end_date',
        'deleted_at',
    ];

    public function farmer(): BelongsTo {
        return $this->belongsTo(Farmer::class)->withDefault();
    }

    public function country(): BelongsTo {
        return $this->belongsTo(Country::class)->withDefault();
    }

    public function province(): BelongsTo {
        return $this->belongsTo(Province::class)->withDefault();
    }

    public function state(): BelongsTo {
        return $this->belongsTo(State::class)->withDefault();
    }

    public function village(): BelongsTo {
        return $this->belongsTo(Village::class)->withDefault();
    }

    public function area(): BelongsTo {
        return $this->belongsTo(Area::class)->withDefault();
    }

    public function departments(): BelongsToMany {
        return $this->belongsToMany(Department::class, 'product_departments');
    }

    public function tags(): BelongsToMany {
        return $this->belongsToMany(Tag::class, 'product_tags');
    }

    // Product Has Many Options ::
    public function options(): HasMany {
        return $this->hasMany(Option::class);
    }
    
    public function image() {
        return $this->morphOne(Image::class, 'imageable');
    }
}