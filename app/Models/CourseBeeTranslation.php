<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class CourseBeeTranslation extends Model {
    use HasFactory;
    protected $table = "course_bee_translations";
    protected $fillable = ['name','desc'];
    public $timestamps = false;
}
