<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
//use Astrotomic\Translatable\Translatable;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Model;
class AdminDepartment extends Model {
    use HasFactory;
//    use HasTranslations;
//    public $translatable = ['dep_name_ar','dep_name_ku','dep_name_en'];
    protected $table = "admin_departments";
    protected $fillable = ['dep_name_ar','dep_name_ku','dep_name_en','desc','keys','parent'];
    public $timestamps = true;



    public function parents(){
        return $this->hasMany(AdminDepartment::class , 'id','parent');
    }

}

