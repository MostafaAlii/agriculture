<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class AboutTranslation extends Model {
    protected $table = "about_translations";
    protected $fillable = ['title','description'];
    public $timestamps = false;
}
