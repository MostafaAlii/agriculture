<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class AgriTServiceTranslation extends Model {
    use HasFactory;
    protected $fillable = ['name'];
    protected $table = "agri_t_service_translations";
    public $timestamps = false;
}
