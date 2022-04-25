<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
class Currency extends Model {
    use HasFactory,HasTranslations;
    protected $table = "currencies";
    public $translatable = ['Name'];
    public $timestamps = true;
}
