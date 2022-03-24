<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class OptionTranslation extends Model{
    use HasFactory;
    protected $table = "option_translations";
    protected $fillable = ['name'];
    // public $translatedAttributes=[];
    public $timestamps = false;
}

