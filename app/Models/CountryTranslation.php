<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class CountryTranslation extends Model {
    use HasFactory;
<<<<<<< HEAD

    protected $guarded = [];
    public $translatedAttributes = ['name'];
=======
    protected $table = "country_translations";
    protected $fillable = ['name'];
>>>>>>> ecd3de33bb7bc165efc778b35c269c8fcd330ad3
    public $timestamps = false;
}
