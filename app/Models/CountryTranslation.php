<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class CountryTranslation extends Model {
    use HasFactory;

    protected $guarded = [];
    public $translatedAttributes = ['name'];
    public $timestamps = false;
}
