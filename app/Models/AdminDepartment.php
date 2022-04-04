<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Astrotomic\Translatable\Translatable;

use Illuminate\Database\Eloquent\Model;
class AdminDepartment extends Model {
    use HasFactory,Translatable;
    protected $table = "admin_departments";
    protected $guarded = [];
    protected $with = ['translations'];
    public $translatedAttributes = ['desc','keys'];
    public $timestamps = true;



    public function parents(){
        return $this->hasMany(AdminDepartment::class , 'id','parent');
    }

}
