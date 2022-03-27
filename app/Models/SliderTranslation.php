<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class SliderTranslation extends Model {
    protected $table = "slider_translations";
    protected $fillable = ['title', 'subtitle'];
    public $timestamps = false;
}
