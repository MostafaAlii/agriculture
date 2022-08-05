<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class DepartmentTranslation extends Model {
    use HasFactory;
    
    protected $table = "department_translations";
    protected $fillable = ['name','description','keyword', 'slug'];
    public $timestamps = false;
}