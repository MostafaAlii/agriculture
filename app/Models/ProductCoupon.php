<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class ProductCoupon extends Model {
    use HasFactory;
    protected $table = "product_coupons";
    protected $guarded = [];
    protected $dates = ['start_date', 'expire_date'];
    public $timestamps = true;

    // Coupon Has One Farmer
    public function user(): BelongsTo {
        return $this->belongsTo(Farmer::class);
    }

    public function scopeCouponsWithUser($query) {
        return $query->with('user:id,firstname,lastname')->get();
    }
}