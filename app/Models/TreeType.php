<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;

class TreeType extends Model {
    use HasFactory,Translatable;
    protected $table = "tree_types";
    protected $guarded = [];
    protected $with = ['translations'];
    public $translatedAttributes = ['tree_type'];
    public $timestamps = true;



    public function trees(){
        return $this->hasMany(Tree::class);
    }
}
