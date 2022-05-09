<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class IncomeProduct extends Model {
    use HasFactory;
    protected $table = "income_products";
    protected $guarded=[];
    public $timestamps = true;


    public function unit(){
        return $this->belongsTo(Unit::class,'unit_id');
    }
    public function admin(){
        return $this->belongsTo(Admin::class,'admin_id');
    }

    public function country(){
        return $this->belongsTo(Country::class,'country_id');
    }
    public function province(){
        return $this->belongsTo(Province::class,'province_id');
    }

    public function area(){
        return $this->belongsTo(Area::class,'area_id');
    }
    public function currency(){
        return $this->belongsTo(Currency::class,'currency_id');
    }


    public function whole_product(){
        return $this->belongsTo(WholeProduct::class,'whole_product_id');
    }

}
