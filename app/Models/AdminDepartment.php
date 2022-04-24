<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Astrotomic\Translatable\Translatable;

use Illuminate\Database\Eloquent\Model;
class AdminDepartment extends Model {
    use HasFactory;

    protected $table = "admin_departments";
    protected $fillable = ['dep_name_ar','dep_name_en','key','desc','parent'];

    public $timestamps = true;

    public function parents(){
        return $this->hasMany(AdminDepartment::class , 'id','parent');
    }

}
