<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class TreeTypeTranslation extends Model {
    use HasFactory;
    protected $table = "tree_type_translations";
    public $translatedAttributes = ['tree_type'];
    protected $guarded=[];
    public $timestamps = false;
}
