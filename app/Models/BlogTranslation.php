<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class BlogTranslation extends Model {
    protected $table = "blog_translations";
    protected $fillable = ['title', 'body'];
    public $timestamps = false;
}
