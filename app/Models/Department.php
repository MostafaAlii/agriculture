<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
class Department extends Model {
    use HasFactory,Translatable;
    protected $table = "departments";
    protected $guarded = [];
    public $translatedAttributes = ['name'];
    public $timestamps = true;
}
