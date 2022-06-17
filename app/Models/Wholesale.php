<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;

class Wholesale extends Model {
    use HasFactory,Translatable;
    protected $table = "wholesales";
    protected $guarded = [];
    protected $with = ['translations'];
    public $translatedAttributes = ['Name'];
    public $timestamps = true;
}

