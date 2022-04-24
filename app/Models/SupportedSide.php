<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
class SupportedSide extends Model {
    use HasFactory,HasTranslations;

    protected $table = "supported_sides";
    public $translatable = ['Name'];

}

