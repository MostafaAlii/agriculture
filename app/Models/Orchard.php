<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Astrotomic\Translatable\Translatable;
class Orchard extends Model {
    use HasFactory,Translatable;
    protected $table = "orchards";
    protected $guarded = [];
    protected $with = ['translations'];
    public $translatedAttributes = ['supported_side'];
    public $timestamps = true;


    public function farmer(){
        return $this->belongsTo(Farmer::class,'farmer_id');
}
    public function admin(){
        return $this->belongsTo(Admin::class,'admin_id');
    }

    public function village(){
        return $this->belongsTo(Village::class,'village_id');
    }
    public function adminDepartment(){
        return $this->belongsTo(AdminDepartment::class,'admin_department_id');
    }
    public function landCategory(){
        return $this->belongsTo(LandCategory::class,'land_category_id');
    }
    public function treeTypes(){
        return $this->belongsToMany(TreeType::class);
    }

}


