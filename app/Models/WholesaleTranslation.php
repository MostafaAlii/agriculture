<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class WholesaleTranslation extends Model {
    use HasFactory;
    protected $table = "wholesale_translations";
    protected $fillable = ['Name'];
    public $timestamps = false;
}
