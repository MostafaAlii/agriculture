<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Option extends Model {
    use HasFactory, Translatable;
    protected $table = "options";
    protected $guarded = [];
    protected $with = ['translations'];
    public $translatedAttributes = ['name'];
    public $timestamps = true;

    public function attribute(): BelongsTo {
        return $this->belongsTo(Attribute::class);
    }

    public function product(): BelongsTo {
        return $this->belongsTo(Product::class);
    }
}
