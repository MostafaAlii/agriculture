<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class WholeProductTranslation extends Model {
    use HasFactory;
    public $timestamps = false;
    use HasFactory;
    protected $table = "whole_product_translations";
    public $translatedAttributes = ['name'];
    protected $guarded=[];
}
