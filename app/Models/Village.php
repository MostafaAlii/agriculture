<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Village extends Model implements TranslatableContract{
    use Translatable,HasFactory; // 2. To add translation methods

    // 3. To define which attributes needs to be translated
    public $translatedAttributes = ['name'];
    protected $guarded = [];

    public function state(){
        return $this->belongsTo(State::class ,'state_id');
    }
}




