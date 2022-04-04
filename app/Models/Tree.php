<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;

class Tree extends Model {
    use HasFactory,Translatable;
    protected $table = "trees";
    protected $guarded = [];
    protected $with = ['translations'];
    public $translatedAttributes = ['name'];
    public $timestamps = true;

    public function tree_type(){
        return $this->belongsTo(TreeType::class,'tree_type_id');
    }
}
