<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class ProductTranslation extends Model {
    protected $table = "product_translations";
    protected $fillable = ['name', 'description', 'slug', 'other_data'];
    public $timestamps = false;
}
