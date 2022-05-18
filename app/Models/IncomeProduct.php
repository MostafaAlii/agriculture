<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class IncomeProduct extends Model {
    use HasFactory;
    protected $table = "income_products";
    protected $guarded=[];
    public $timestamps = true;

    const LOCAL ='local',IRAQ ='iraq',IMPORTED='imported';
    public function getCountryProductType() {
        switch ($this->country_product_type) {
            case 'local': $result =   trans('Admin/income_products.local'); break;
            case 'iraq': $result = trans('Admin/income_products.iraq') ; break;
            case 'imported': $result =  trans('Admin/income_products.imported') ; break;
        }
        return $result;
    }


    public function unit(){
        return $this->belongsTo(Unit::class,'unit_id');
    }
    public function admin(){
        return $this->belongsTo(Admin::class,'admin_id');
    }

    public function country(){
        return $this->belongsTo(Country::class,'country_id');
    }

    public function currency(){
        return $this->belongsTo(Currency::class,'currency_id');
    }


    public function whole_product(){
        return $this->belongsTo(WholeProduct::class,'whole_product_id');
    }



}
