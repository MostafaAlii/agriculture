<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class StateTranslation extends Model {
    use HasFactory;
    public $timestamps = false;



    protected $table = "state_translations";
    protected $fillable = ['name'];
}
