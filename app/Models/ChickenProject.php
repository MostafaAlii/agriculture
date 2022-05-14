<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class ChickenProject extends Model
{
    use HasFactory;
    protected $table = "chicken_projects";
    protected $guarded = [];
    public $timestamps = true;
    const LOCAL = 'local', IMPORTED = 'imported', SPATIAL = 'private',GOVERMENTAL='govermental';

    public function getFoodSource() {
        switch ($this->food_source) {
            case 'local': $result =   trans('Admin/animals.local'); break;
            case 'imported': $result = trans('Admin/animals.imported') ; break;
        }
        return $result;
    }
    public function getSuseSource() {
        switch ($this->suse_source) {
            case 'local': $result =   trans('Admin/animals.local'); break;
            case 'imported': $result = trans('Admin/animals.imported') ; break;
        }
        return $result;
    }
    public function getMarketingSide() {
        switch ($this->marketing_side) {
            case 'private': $result =   trans('Admin/animals.private'); break;
            case 'govermental': $result = trans('Admin/animals.govermental') ; break;
        }
        return $result;
    }

    public function farmer()
    {
        return $this->belongsTo(Farmer::class, 'farmer_id');
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }



    public function village()
    {
        return $this->belongsTo(Village::class, 'village_id');
    }
    public function area(){
        return $this->belongsTo(Area::class,'area_id');
    }
    public function state(){
        return $this->belongsTo(State::class,'state_id');
    }

}