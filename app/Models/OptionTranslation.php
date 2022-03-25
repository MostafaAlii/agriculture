<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class OptionTranslation extends Model {
    use HasFactory;
    protected $table = "option_translations";
    protected $fillable = ['name'];
    public $timestamps = false;
}
