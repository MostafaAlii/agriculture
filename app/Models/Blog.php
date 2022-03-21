<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
class Blog extends Model {
    use HasFactory, Translatable;
    const PUBLIC_VISIBIILTY = 1;
    const FOR_ADMIN_AND_EMPLOYEE_ONLY_VISIBIILTY = 2;
    const FOR_FARMER_AND_VENDOR_ONLY_VISIBIILTY = 3;
    const FOR_ONLY_ME_VISIBIILTY = 4;

    protected $table = "blogs";
    protected $guarded = [];
    protected $with = ['translations'];
    public $translatedAttributes = ['title', 'body'];
    public $timestamps = true;

    public function image() {
        return $this->morphOne(Image::class, 'imageable');
    }

    // Blog Has One Auther -> Admin or Employee or ----
    public function admin(): BelongsTo {
        return $this->belongsTo(Admin::class);
    }
}
