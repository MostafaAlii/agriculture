<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class CategoryTranslation extends Model {
    use HasFactory;
    
    protected $table = "category_translations";
    protected $fillable = ['name','description','keyword', 'slug'];
    public $timestamps = false;
}