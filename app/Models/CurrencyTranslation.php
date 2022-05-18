<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class CurrencyTranslation extends Model {
    use HasFactory;
    protected $guarded = [];
    public $translatedAttributes = ['Name'];
    protected $table = "currency_translations";
    public $timestamps = false;
}
