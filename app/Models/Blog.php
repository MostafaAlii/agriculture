<?php
namespace App\Models;
use App\Traits\HasImage;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\{BelongsTo,BelongsToMany};
class Blog extends Model {
    use HasFactory, Translatable, HasImage;
    const PUBLIC_VISIBIILTY = 1;
    const FOR_ADMIN_AND_EMPLOYEE_ONLY_VISIBIILTY = 2;
    const FOR_FARMER_AND_VENDOR_ONLY_VISIBIILTY = 3;
    const FOR_ONLY_ME_VISIBIILTY = 4;

    protected $table = "blogs";
    protected $guarded = [];
    protected $with = ['translations'];
    public $translatedAttributes = ['title', 'body'];
    public $timestamps = true;
    public $appends = ['image_path'];


    public function scopeWhenSearch($query, $search) {
        return $query->when($search, function ($q) use ($search) { 
            return $q->whereHas('title', 'like', "%{$search}%");
        });

    }// end of scopeWhenSearch

    // Blog Has One Auther -> Admin or Employee or ----
    public function admin(): BelongsTo {
        return $this->belongsTo(Admin::class);
    }

    public function categories(): BelongsToMany {
        return $this->belongsToMany(Category::class, 'blog_categories');
    }

    public function tags(): BelongsToMany {
        return $this->belongsToMany(Tag::class, 'blog_tags');
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}