<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class BeeDisasterTranslation extends Model {
    use HasFactory;
    protected $table = "bee_disaster_translations";
    protected $fillable = ['name','desc'];
    public $timestamps = false;
}
