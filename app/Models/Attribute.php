<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;

class Attribute extends Model implements TranslatableContract{
    
    use HasFactory,Translatable;

    protected $table = "attributes";
    protected $guarded = [];

    protected $with=['translations'];
    public $translatedAttributes=['name'];

    public $timestamps = true;

    public function options(): HasMany {
        return $this->hasMany(Option::class);
    }

}
