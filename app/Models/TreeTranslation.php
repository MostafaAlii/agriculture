<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class TreeTranslation extends Model {
    use HasFactory;
    protected $table = "tree_translations";
    protected $guarded=[];
    public $translatedAttributes = ['name'];
    public $timestamps = false;

}