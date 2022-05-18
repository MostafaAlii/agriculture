<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class AdminDepartmentTranslation extends Model {
    use HasFactory;
    protected $fillable = ['name'];
    protected $table = "admin_department_translations";
    public $timestamps = false;

}
