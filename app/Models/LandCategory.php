<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;

class LandCategory extends Model {
    use HasFactory,Translatable;
    protected $table = "land_categories";
    protected $fillable = [];
    protected $with = ['translations'];
    public $translatedAttributes = ['category_name','category_type'];

    public $timestamps = true;
    const  AGRICULTURE = 'agriculture', NON_AGRICULTURE ='non_agriculture';
    public function getCategoryType() {
        switch ($this->category_type) {
            case 'agriculture': $result =   trans('Admin/lands.agriculture'); break;
            case 'non_agriculture': $result = trans('Admin/lands.non_agriculture') ; break;
        }
        return $result;
    }
}
