<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class AgriServiceTranslation extends Model {
    use HasFactory;
    protected $fillable = ['name'];
    protected $table = "agri_service_translations";
    public $timestamps = false;
}
