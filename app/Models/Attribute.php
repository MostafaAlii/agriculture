<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Attribute extends Model {
    use HasFactory, Translatable;
    protected $table = "attributes";
    protected $fillable = ['parent_id','department_id'];
  //  protected $guarded = [];
    protected $with = ['translations'];
    public $translatedAttributes = ['name'];
    public $timestamps = true;

    // Attributes Has Many Options ::
    public function options(): HasMany {
        return $this->hasMany(Option::class);
    }
}