<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
class DepartmentTranslation extends Model {
    use HasFactory,Translatable;
    
    protected $table = "department_translations";
    protected $guarded = [];
    public $translatedAttributes=[];
    public $timestamps = false;
}
