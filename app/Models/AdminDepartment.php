<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Astrotomic\Translatable\Translatable;

use Illuminate\Database\Eloquent\Model;
class AdminDepartment extends Model {
    use HasFactory,Translatable;

    protected $table = "admin_departments";
    protected $guarded = [];

    public $translatedAttributes=['name'];
    public $timestamps = true;
    protected $with=['translations'];

    public function parents(){
        return $this->hasMany(AdminDepartment::class , 'id','parent');
    }

}




