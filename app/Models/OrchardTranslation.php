<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class OrchardTranslation extends Model {
    use HasFactory;
    protected $table = "orchard_translations";
    protected $guarded = [];
    public $translatedAttributes = ['supported_side'];

    public $timestamps = false;
}
