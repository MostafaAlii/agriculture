<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
class Orchard extends Model {
    use HasFactory;
    public $timestamps = true;
    protected $table = "orchards";
    protected $guarded = [];
    const SPATIAL = 'private', GOVERMENTAL = 'govermental', INTERNATIONAL_ORGANIZATION = 'international organizations';
    public function getSupportedSide() {
        switch ($this->supported_side) {
            case 'private': $result =   trans('Admin/orchards.private'); break;
            case 'govermental': $result = trans('Admin/orchards.govermental') ; break;
            case 'international organizations': $result =  trans('Admin/orchards.international_organizations') ; break;
        }
        return $result;
    }
    public function unit(){
        return $this->belongsTo(Unit::class,'unit_id');
    }


    public function farmer(){
        return $this->belongsTo(Farmer::class,'farmer_id');
    }
    public function admin(){
        return $this->belongsTo(Admin::class,'admin_id');
    }

    public function village(){
        return $this->belongsTo(Village::class,'village_id');
    }
    public function area(){
        return $this->belongsTo(Area::class,'area_id');
    }
    public function state(){
        return $this->belongsTo(State::class,'state_id');
    }
    public function landCategory(){
        return $this->belongsTo(LandCategory::class,'land_category_id');
    }
    public function trees(){
        return $this->belongsToMany(Tree::class,'orchard_trees','orchard_id','tree_id');
    }


}


