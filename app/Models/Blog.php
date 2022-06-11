<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Blog extends Model {
    use HasFactory, Translatable;
    const PUBLIC_VISIBIILTY = 1;
    const FOR_ADMIN_AND_EMPLOYEE_ONLY_VISIBIILTY = 2;
    const FOR_FARMER_AND_VENDOR_ONLY_VISIBIILTY = 3;
    const FOR_ONLY_ME_VISIBIILTY = 4;

    protected $table = "blogs";
    // protected $fillable = [
    //     'status',
    //     'visibility',
    //     'admin_id',
    // ];
    protected $guarded = [];
    protected $with = ['translations'];
    public $translatedAttributes = ['title', 'body'];
    public $timestamps = true;


    public function scopeWhenSearch($query, $search)
    {
        // $sss = BlogTranslation::whereHas('translations', function ($query) {
        //     $query
        //         ->where('locale', 'en')
        //         ->where('title', 'like', "%{$search}%");
        // })->first();
        // dd($sss);
        return $query->when($search, function ($q) use ($search) {
            // 'title', 'like', '%' . $search . '%'
            return $q->whereHas('title', 'like', "%{$search}%")
                    //  ->orWhere('body', 'like', "%{$search}%")
                     ;

        });

    }// end of scopeWhenSearch

    public function image() {
        return $this->morphOne(Image::class, 'imageable');
    }

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
