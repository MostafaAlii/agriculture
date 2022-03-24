<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class AttributeTranslation extends Model {
    protected $table = "attribute_translations";
    protected $fillable = ['name'];
    public $timestamps = false;
}
