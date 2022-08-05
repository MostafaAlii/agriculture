<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BlogTranslation extends Model {
    protected $table = "blog_translations";
    protected $fillable = ['title', 'body'];
    public $timestamps = false;

    public function blog(): BelongsTo {
        return $this->belongsTo(Blog::class);
    }
}
