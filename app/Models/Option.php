<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Astrotomic\Translatable\Translatable;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;

class Option extends Model implements TranslatableContract{
    
    use HasFactory,Translatable;

    protected $table = "options";
    protected $guarded = [];

    protected $with=['translations'];
    public $translatedAttributes=['name'];

    public $timestamps = true;

    public function attribute() {
        return $this->belongsTo(Attribute::class);
    }

}
