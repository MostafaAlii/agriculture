<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class WholeSale extends Model {
    use HasFactory;
    protected $table = "bee_keepers";
    protected $guarded=[];
    public $timestamps = true;


    public function unit(){
        return $this->belongsTo(Unit::class,'unit_id');
    }

    public function country(){
        return $this->belongsTo(Country::class,'country_id');
    }
    public function province(){
        return $this->belongsTo(Province::class,'area_id');
    }

    public function area(){
        return $this->belongsTo(Area::class,'area_id');
    }


    public function adminDepartment(){
        return $this->belongsTo(AdminDepartment::class,'admin_department_id');
    }
    public function whole_sale_products(){
        return $this->belongsTo(WholeSaleProduct::class,'whole_sale_product_id');
    }

}
