<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class CountryTranslation extends Model {
    use HasFactory;
    protected $table = "country_translations";
    protected $fillable = ['name'];
    public $timestamps = false;
}
