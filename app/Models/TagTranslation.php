<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class TagTranslation extends Model {
    use HasFactory;
    protected $table = "tag_translations";
    protected $fillable = ['name'];
    public $timestamps = false;
}
